@props([
    'label' => 'Imagem',
    'urlName' => 'image_url',
    'fileName' => 'image_file',
    'value' => '',
    'accept' => 'image/*',
])

<div>
    <label class="block text-sm font-medium text-white mb-2">{{ $label }}</label>

    <div class="flex items-center space-x-4 mb-4">
        <button type="button" id="btnLink"
            class="px-4 py-2 rounded-lg text-white font-semibold focus:outline-none flex flex-row bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
            </svg>
            Usar Link
        </button>
        <button type="button" id="btnFile"
            class="px-4 py-2 rounded-lg text-white font-semibold focus:outline-none flex flex-row bg-gray-700">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
            </svg>

            Enviar Arquivo
        </button>
    </div>

    <div id="linkContainer" class="hidden">
        <input type="text" name="{{ $urlName }}" id="url"
            value="{{ $value }}"
            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
            placeholder="https://exemplo.com/imagem.jpg">
    </div>

    <div id="fileContainer" class="hidden">
        <input type="file" name="{{ $fileName }}" id="file"
            accept="{{ $accept }}"
            class="mt-2 block w-full text-sm text-gray-400
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-red-500 file:text-white
                hover:file:bg-red-600">
    </div>

    <div class="mt-4 {{ $value ? '' : 'hidden' }}" id="previewWrapper">
        <img id="preview" src="{{ getCoverUrl($value) }}"
             alt="Preview" class="max-h-64 rounded-lg border border-gray-700"
             onerror="this.src=''; this.closest('div').classList.add('hidden');">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnLink = document.getElementById('btnLink');
    const btnFile = document.getElementById('btnFile');
    const linkContainer = document.getElementById('linkContainer');
    const fileContainer = document.getElementById('fileContainer');
    const urlInput = document.getElementById('url');
    const fileInput = document.getElementById('file');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewImg = document.getElementById('preview');

    function setActive(btnActive, btnInactive) {
        btnActive.classList.add('bg-red-500');
        btnActive.classList.remove('bg-gray-700');
        btnInactive.classList.remove('bg-red-500');
        btnInactive.classList.add('bg-gray-700');
    }

    function showPreview(src) {
        if (!src) return;
        previewImg.src = src;
        previewWrapper.classList.remove('hidden');
    }

    function hidePreview() {
        previewWrapper.classList.add('hidden');
        previewImg.src = '';
    }

    function showLink() {
        linkContainer.classList.remove('hidden');
        fileContainer.classList.add('hidden');
        setActive(btnLink, btnFile);
        if (urlInput.value) showPreview(urlInput.value);
        else hidePreview();
    }

    function showFile() {
        fileContainer.classList.remove('hidden');
        linkContainer.classList.add('hidden');
        urlInput.value = '';
        setActive(btnFile, btnLink);
        if (fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = e => showPreview(e.target.result);
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    btnLink.addEventListener('click', showLink);
    btnFile.addEventListener('click', showFile);

    urlInput.addEventListener('input', () => {
        if (urlInput.value) showPreview(urlInput.value);
        else if (!fileInput.files.length) hidePreview();
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = e => showPreview(e.target.result);
            reader.readAsDataURL(fileInput.files[0]);
        } else if (!urlInput.value) hidePreview();
    });

    @if($value)
        @if(Str::startsWith($value, 'http'))
            showLink();
        @else
            showFile();
        @endif
    @endif
});
</script>

<x-admin-layout>
    <x-slot name="header">
        Edit Berita
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.news.update', $news->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>

                            <!-- Existing Image -->
                            @if($news->image)
                                <div id="existing-image" class="mb-3">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                        class="w-48 h-auto rounded-lg object-cover shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                                </div>
                            @endif

                            <!-- Image Preview Container (Initially Hidden if using existing image, but logic handles swap) -->
                            <div id="image-preview" class="hidden mb-3">
                                <img src="" alt="Preview Gambar Baru"
                                    class="w-48 h-auto rounded-lg object-cover shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">Preview gambar baru</p>
                            </div>

                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-50 file:text-emerald-700
                                hover:file:bg-emerald-100" accept="image/*" onchange="previewImage(this)">

                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.
                                Format: jpeg, png, jpg, webp. Maksimal 5MB.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita
                                *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="categories" class="block text-sm font-medium text-gray-700 mb-2">Kategori
                                    *</label>
                                <select name="categories[]" id="categories" multiple="multiple"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    @foreach($news->categories as $category)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                    *</label>
                                <select name="status" id="status"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="archived" {{ old('status', $news->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="editor" class="block text-sm font-medium text-gray-700 mb-2">Isi Berita
                                *</label>
                            <textarea id="editor" name="content">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Update
                                Berita</button>
                            <a href="{{ route('admin.news.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (Required for Summernote & Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Summernote Lite CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Select2 CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .note-editor.note-frame.fullscreen {
            background-color: white;
        }

        /* Fix for Tailwind CSS resetting list styles */
        .note-editable ul {
            list-style-type: disc !important;
            padding-left: 2.5rem !important;
            /* ml-10 equivalent */
        }

        .note-editable ol {
            list-style-type: decimal !important;
            padding-left: 2.5rem !important;
            /* ml-10 equivalent */
        }

        /* Select2 Tailwind Fixes */
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: auto !important;
            padding: 0.5rem !important;
            border-color: #d1d5db !important;
            /* gray-300 */
            border-radius: 0.375rem !important;
            /* rounded-md */
        }
    </style>

    <script>
        $(document).ready(function () {
            // -- Summernote Init --
            $('#editor').summernote({
                placeholder: 'Tulis isi berita disini...',
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        if (files.length == 0) return;
                        var file = files[0];
                        if (file.size > 5 * 1024 * 1024) { // 5MB Limit
                            alert('Ukuran gambar terlalu besar. Maksimal 5MB.');
                            return;
                        }
                        
                        var data = new FormData();
                        data.append("image", file);
                        data.append("_token", "{{ csrf_token() }}");
                        
                        $.ajax({
                            url: "{{ route('admin.news.upload-image') }}",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: data,
                            type: "POST",
                            success: function(url) {
                                var image = $('<img>').attr('src', url);
                                $('#editor').summernote("insertNode", image[0]);
                            },
                            error: function(data) {
                                console.log(data);
                                alert('Gagal upload gambar. Silakan coba lagi.');
                            }
                        });
                    }
                }
            });

            // -- Select2 Init --
            $('#categories').select2({
                placeholder: 'Pilih Kategori',
                ajax: {
                    url: '/admin/categories/search',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                tags: true, // Allow creation
                createTag: function (params) {
                    var term = params.term;
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true
                    }
                }
            });

            // Handle Creating New Tag via Ajax
            $('#categories').on('select2:select', function (e) {
                var data = e.params.data;
                if (data.newTag) {
                    $.ajax({
                        url: '/admin/categories/store',
                        method: 'POST',
                        data: {
                            name: data.text,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            var newOption = new Option(response.text, response.id, true, true);
                            $('#categories').find("option[value='" + data.id + "']").remove();
                            $('#categories').append(newOption).trigger('change');
                        },
                        error: function (error) {
                            console.error('Error creating category:', error);
                        }
                    });
                }
            });

            // -- Auto-save Logic --
            let newsId = "{{ $news->id }}";

            // Auto-save every 10 minutes (600000 ms)
            setInterval(function () {
                saveDraft();
            }, 600000);

            function saveDraft() {
                const title = $('input[name="title"]').val();
                const content = $('#editor').summernote('code');
                const categories = $('#categories').val();

                if (!title) return;

                const formData = new FormData();
                formData.append('title', title);
                formData.append('content', content);
                formData.append('status', 'draft');

                formData.append('_token', '{{ csrf_token() }}');

                if (categories) {
                    categories.forEach(cat => formData.append('categories[]', cat));
                }

                if (newsId) {
                    formData.append('news_id', newsId);
                }

                $.ajax({
                    url: "{{ route('admin.news.autosave') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('Autosaved', response);
                    },
                    error: function (err) {
                        console.error('Autosave failed', err);
                    }
                });
            }
        });
    </script>
    <script>
        function previewImage(input) {
            const previewContainer = document.getElementById('image-preview');
            const existingImage = document.getElementById('existing-image');
            const previewImage = previewContainer.querySelector('img');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    if (existingImage) {
                        existingImage.classList.add('hidden');
                    }
                }

                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                if (existingImage) {
                    existingImage.classList.remove('hidden');
                }
            }
        }
    </script>
</x-admin-layout>

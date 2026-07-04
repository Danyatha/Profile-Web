<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<?php
// Deteksi mode: edit atau create
$isEdit  = isset($journal);
$action  = $isEdit
    ? base_url('admin/journals/update/' . $journal['id'])
    : base_url('admin/journals/store');
?>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<style>
    /* ====== Quill sticky toolbar ====== */
    /* Kalau layout admin punya navbar fixed di atas, ubah --qtoolbar-top
       jadi setinggi navbar tsb, mis. 60px. Default 0 (tanpa navbar fixed). */
    #editor-wrapper { --qtoolbar-top: 0px; }

    #editor-wrapper .ql-toolbar.ql-snow {
        position: sticky;
        top: var(--qtoolbar-top);
        z-index: 20;
        background: #fff;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,.06);
    }

    #editor-container {
        min-height: 360px;
        max-height: 60vh;     /* area tulis punya tinggi tetap */
        overflow-y: auto;     /* scroll terjadi di dalam editor */
        background: #fff;
    }

    /* Gambar di dalam editor: jangan meluber, jaga proporsi saat resize */
    #editor-container .ql-editor img {
        max-width: 100%;
        height: auto;
    }
    /* Align gambar (module Toolbar menyimpan via class ql-align-* / float) */
    #editor-container .ql-editor .ql-align-center { text-align: center; }
    #editor-container .ql-editor .ql-align-right  { text-align: right; }
</style>

<!-- Header -->
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="<?= base_url('admin/journals') ?>" class="btn btn-sm btn-outline-secondary">← Kembali</a>
    <h2 class="fw-bold mb-0" style="color:var(--navy-blue);">
        <?= $isEdit ? 'Edit Journal' : 'Tambah Journal' ?>
    </h2>
</div>

<!-- Validation Errors -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Form -->
<form action="<?= $action ?>" method="post" enctype="multipart/form-data" id="journal-form">
    <?= csrf_field() ?>

    <div class="row g-4">

        <!-- ============================================================= -->
        <!-- Kolom Kiri: Konten                                            -->
        <!-- ============================================================= -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm p-4">

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                    <input type="text"
                        id="title"
                        name="title"
                        class="form-control <?= (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '' ?>"
                        value="<?= old('title', $journal['title'] ?? '') ?>"
                        placeholder="Judul jurnal..."
                        required>
                    <?php if (isset($validation) && $validation->hasError('title')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('title') ?></div>
                    <?php endif; ?>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label fw-semibold">Kategori</label>
                    <div class="input-group">
                        <input type="text"
                            id="category"
                            name="category"
                            class="form-control"
                            value="<?= old('category', $journal['category'] ?? '') ?>"
                            placeholder="Ketik atau pilih kategori..."
                            list="category-list">
                        <datalist id="category-list">
                            <?php foreach ($categories as $cat): ?>
                                <?php if (!empty($cat['category'])): ?>
                                    <option value="<?= esc($cat['category']) ?>"></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </datalist>
                    </div>
                    <div class="form-text">Kosongkan jika tidak perlu kategori.</div>
                </div>

                <!-- Content (Quill) -->
                <div class="mb-1">
                    <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>

                    <!-- Wrapper untuk konteks sticky toolbar -->
                    <div id="editor-wrapper">
                        <div id="editor-container"></div>
                    </div>

                    <!-- Hidden field yang benar-benar dikirim ke server -->
                    <textarea name="content" id="content" class="d-none"><?= old('content', $journal['content'] ?? '') ?></textarea>

                    <?php if (isset($validation) && $validation->hasError('content')): ?>
                        <div class="text-danger small mt-1"><?= $validation->getError('content') ?></div>
                    <?php endif; ?>
                    <div class="form-text">Gunakan toolbar untuk memformat teks, menambah heading, list, link, atau gambar.</div>
                </div>

            </div>
        </div>

        <!-- ============================================================= -->
        <!-- Kolom Kanan: Sidebar                                          -->
        <!-- ============================================================= -->
        <div class="col-12 col-lg-4">

            <!-- Publish Settings -->
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h6 class="fw-bold mb-3">Pengaturan Publish</h6>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_published"
                                id="status_published" value="1"
                                <?= (old('is_published', $journal['is_published'] ?? 1) == 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_published">Published</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_published"
                                id="status_draft" value="0"
                                <?= (old('is_published', $journal['is_published'] ?? 1) == 0) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_draft">Draft</label>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary w-100">
                    <?= $isEdit ? '💾 Simpan Perubahan' : '🚀 Publikasikan' ?>
                </button>
            </div>

            <!-- Cover Image -->
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h6 class="fw-bold mb-3">Cover Image</h6>

                <!-- Preview gambar lama -->
                <?php if ($isEdit && !empty($journal['cover_image'])): ?>
                    <div class="mb-3" id="current-cover-wrapper">
                        <p class="text-muted small mb-1">Cover saat ini:</p>
                        <img src="<?= base_url($journal['cover_image']) ?>"
                            id="cover-preview"
                            alt="Cover"
                            class="img-fluid rounded mb-2"
                            style="max-height:180px; width:100%; object-fit:cover;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_cover"
                                id="remove_cover" value="1">
                            <label class="form-check-label text-danger small" for="remove_cover">
                                Hapus cover ini
                            </label>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Preview untuk upload baru -->
                    <img id="cover-preview"
                        src=""
                        alt=""
                        class="img-fluid rounded mb-2 d-none"
                        style="max-height:180px; width:100%; object-fit:cover;">
                <?php endif; ?>

                <label for="cover_image" class="form-label fw-semibold small">
                    <?= ($isEdit && !empty($journal['cover_image'])) ? 'Ganti Cover' : 'Upload Cover' ?>
                </label>
                <input type="file"
                    id="cover_image"
                    name="cover_image"
                    class="form-control form-control-sm"
                    accept="image/jpeg,image/png,image/webp"
                    onchange="previewCover(this)">
                <div class="form-text">JPG / PNG / WEBP, maks. 2MB.</div>
            </div>

            <!-- Dokumen Lampiran -->
            <div class="card border-0 shadow-sm p-4">
                <h6 class="fw-bold mb-3">Dokumen Lampiran</h6>

                <!-- Dokumen lama (mode edit) -->
                <?php if ($isEdit && !empty($journal['document_file'])): ?>
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Dokumen saat ini:</p>
                        <div class="d-flex align-items-center gap-2 p-2 border rounded mb-2">
                            <span style="font-size:18px;">📄</span>
                            <a href="<?= base_url($journal['document_file']) ?>"
                               target="_blank" rel="noopener"
                               class="small text-truncate flex-grow-1"
                               style="max-width:100%;">
                                <?= esc($journal['document_name'] ?: 'Dokumen') ?>
                            </a>
                            <?php if (!empty($journal['document_type'])): ?>
                                <span class="badge bg-secondary"><?= esc(strtoupper($journal['document_type'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_document"
                                   id="remove_document" value="1">
                            <label class="form-check-label text-danger small" for="remove_document">
                                Hapus dokumen ini
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <label for="document_file" class="form-label fw-semibold small">
                    <?= ($isEdit && !empty($journal['document_file'])) ? 'Ganti Dokumen' : 'Upload Dokumen' ?>
                </label>
                <input type="file"
                       id="document_file"
                       name="document_file"
                       class="form-control form-control-sm"
                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                <div class="form-text">PDF / DOC / XLS / PPT, maks. 10MB. 1 file per jurnal.</div>
            </div>

        </div>
    </div>
</form>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<!-- Module resize gambar (drag-resize + align ala Word). Dimuat opsional;
     kalau gagal load, editor tetap jalan normal tanpa fitur resize. -->
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    // ── Cover preview ──
    function previewCover(input) {
        const preview = document.getElementById('cover-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ── Quill editor ──
    // Daftarkan module resize gambar bila script-nya berhasil dimuat.
    // Kalau CDN gagal / bentrok, editor tetap jalan tanpa fitur resize.
    let imageResizeAvailable = false;
    try {
        const ImageResize = window.ImageResize && (window.ImageResize.default || window.ImageResize);
        if (ImageResize) {
            Quill.register('modules/imageResize', ImageResize);
            imageResizeAvailable = true;
        }
    } catch (err) {
        console.warn('Module imageResize tidak tersedia, editor jalan tanpa resize gambar.', err);
    }

    const quillModules = {
        toolbar: [
            // header 1 ditambahkan supaya konten lama dgn <h1> tidak distrip
            // (penyebab umum DOM reflow + scroll loncat saat paste/format)
            [{ header: [1, 2, 3, 4, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link', 'image'],
            [{ align: [] }],
            ['clean']
        ]
    };

    // Aktifkan resize hanya jika module-nya siap.
    if (imageResizeAvailable) {
        quillModules.imageResize = {
            // Resize  = handle drag di pojok gambar
            // DisplaySize = tampilkan ukuran px saat di-drag
            // Toolbar = tombol align kiri/tengah/kanan + full width
            modules: ['Resize', 'DisplaySize', 'Toolbar']
        };
    }

    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tulis jurnal kamu di sini...',
        modules: quillModules
    });

    // Pindahkan toolbar ke dalam #editor-wrapper agar sticky-nya
    // berkonteks pada wrapper (bukan card), jadi tidak terpotong padding card.
    const wrapper = document.getElementById('editor-wrapper');
    const toolbar = wrapper.previousElementSibling; // .ql-toolbar dibuat tepat sebelum container
    if (toolbar && toolbar.classList.contains('ql-toolbar')) {
        wrapper.insertBefore(toolbar, wrapper.firstChild);
    }

    const contentField    = document.getElementById('content');
    const editorContainer = document.getElementById('editor-container');

    // ─────────────────────────────────────────────────────────────
    // FIX: editor "loncat ke atas / view balik ke tulisan awal" saat
    // ganti heading. Quill memanggil scroll-into-view BEBERAPA KALI
    // (termasuk setelah rAF kita), jadi sekadar restore sekali tidak cukup.
    //
    // Strategi: saat format diubah, AKTIFKAN "scroll guard" selama ~300ms.
    // Selama guard aktif, setiap percobaan scroll dari Quill langsung
    // dikembalikan ke posisi yang kita kunci.
    // ─────────────────────────────────────────────────────────────
    let lockedScroll = null;
    let guardUntil   = 0;

    function lockScroll() {
        lockedScroll = editorContainer.scrollTop;
        guardUntil   = performance.now() + 300; // tahan 300ms
    }

    // Selama guard aktif, paksa scrollTop kembali ke posisi terkunci.
    editorContainer.addEventListener('scroll', function () {
        if (lockedScroll !== null && performance.now() < guardUntil) {
            if (editorContainer.scrollTop !== lockedScroll) {
                editorContainer.scrollTop = lockedScroll;
            }
        } else {
            lockedScroll = null; // guard habis → biarkan user scroll bebas
        }
    });

    // Pasang lock SEBELUM Quill memproses perubahan format.
    // capture:true supaya jalan duluan sebelum handler Quill.
    const qlToolbar = document.querySelector('.ql-toolbar');
    if (qlToolbar) {
        // Dropdown header pakai <select> → event 'change'
        qlToolbar.addEventListener('mousedown', lockScroll, true);
        qlToolbar.addEventListener('change',    lockScroll, true);
    }

    // Backup: tiap kali DOM editor diubah Quill, perpanjang guard sedikit
    // memakai posisi yang sudah dikunci (bukan posisi baru).
    quill.on('editor-change', function (eventName) {
        if (eventName === 'selection-change') return;
        if (lockedScroll === null) return;
        guardUntil = performance.now() + 300;
        requestAnimationFrame(() => {
            if (lockedScroll !== null) editorContainer.scrollTop = lockedScroll;
        });
    });

    // ── Muat konten awal (mode edit / old input) tanpa memicu scroll ──
    // Pakai convert + setContents('silent') agar tidak ada event/scroll
    // saat inisialisasi (lebih aman dari dangerouslyPasteHTML).
    if (contentField.value.trim() !== '') {
        const delta = quill.clipboard.convert(contentField.value);
        quill.setContents(delta, 'silent');
    }

    // Sinkronkan setiap perubahan ke hidden textarea
    quill.on('text-change', function () {
        contentField.value = quill.root.innerHTML;
    });

    // Validasi & sync final saat submit
    document.getElementById('journal-form').addEventListener('submit', function (e) {
        // Pastikan nilai terbaru tersalin
        contentField.value = quill.root.innerHTML;

        // Cek konten benar-benar kosong (Quill kosong = "<p><br></p>")
        const plain = quill.getText().trim();
        if (plain.length < 10) {
            e.preventDefault();
            alert('Konten wajib diisi minimal 10 karakter.');
            quill.focus();
        }
    });
</script>

<?= $this->endSection() ?>
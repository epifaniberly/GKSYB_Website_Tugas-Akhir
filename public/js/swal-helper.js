/**
 * SweetAlert Helper - Standardized SweetAlert configurations
 * Ensures consistent design across all admin pages
 */

const SwalHelper = {
    brandColor: '#8C1007',
    
    /**
     * Konfirmasi Edit Data
     * @param {string} itemName - Nama item yang akan diedit (opsional)
     * @returns {Promise}
     */
    confirmEdit(itemName = 'data') {
        return Swal.fire({
            title: 'Simpan Perubahan?',
            text: `Apakah Anda yakin ingin menyimpan perubahan ${itemName}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: this.brandColor,
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        });
    },

    /**
     * Berhasil Edit Data
     * @param {string} message - Pesan sukses (opsional)
     * @returns {Promise}
     */
    successEdit(message = 'Data berhasil diperbarui') {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            confirmButtonColor: this.brandColor,
            timer: 2000,
            timerProgressBar: true
        });
    },

    /**
     * Konfirmasi Hapus Data
     * @param {string} itemName - Nama item yang akan dihapus (opsional)
     * @returns {Promise}
     */
    confirmDelete(itemName = 'data') {
        return Swal.fire({
            title: 'Hapus Data?',
            html: `Apakah Anda yakin ingin menghapus ${itemName}?<br><span class="text-sm text-gray-500">Data yang dihapus tidak dapat dikembalikan!</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DC2626',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        });
    },

    /**
     * Berhasil Hapus Data
     * @param {string} message - Pesan sukses (opsional)
     * @returns {Promise}
     */
    successDelete(message = 'Data berhasil dihapus') {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            confirmButtonColor: this.brandColor,
            timer: 2000,
            timerProgressBar: true
        });
    },

    /**
     * Berhasil Tambah Data
     * @param {string} message - Pesan sukses (opsional)
     * @returns {Promise}
     */
    successAdd(message = 'Data berhasil ditambahkan') {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            confirmButtonColor: this.brandColor,
            timer: 2000,
            timerProgressBar: true
        });
    },

    /**
     * Berhasil Upload File
     * @param {string} message - Pesan sukses (opsional)
     * @returns {Promise}
     */
    successUpload(message = 'File berhasil diupload') {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            confirmButtonColor: this.brandColor,
            timer: 2000,
            timerProgressBar: true
        });
    },

    /**
     * Gagal Edit Data (Error Sistem)
     * @param {string} message - Pesan error
     * @returns {Promise}
     */
    errorEdit(message = 'Terjadi kesalahan saat menyimpan data') {
        return Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message,
            confirmButtonColor: this.brandColor
        });
    },

    /**
     * Gagal Hapus Data (Error Sistem)
     * @param {string} message - Pesan error
     * @returns {Promise}
     */
    errorDelete(message = 'Terjadi kesalahan saat menghapus data') {
        return Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message,
            confirmButtonColor: this.brandColor
        });
    },

    /**
     * Gagal Tambah Data (Error Sistem)
     * @param {string} message - Pesan error
     * @returns {Promise}
     */
    errorAdd(message = 'Terjadi kesalahan saat menambahkan data') {
        return Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message,
            confirmButtonColor: this.brandColor
        });
    },

    /**
     * Error Koneksi
     * @param {string} message - Pesan error (opsional)
     * @returns {Promise}
     */
    errorConnection(message = 'Koneksi terputus. Periksa internet Anda dan coba lagi.') {
        return Swal.fire({
            icon: 'error',
            title: 'Koneksi Gagal!',
            text: message,
            confirmButtonColor: this.brandColor
        });
    },

    /**
     * Session Expired
     * @returns {Promise}
     */
    sessionExpired() {
        return Swal.fire({
            icon: 'warning',
            title: 'Sesi Berakhir!',
            text: 'Sesi login Anda telah berakhir. Silakan login kembali.',
            confirmButtonColor: this.brandColor,
            confirmButtonText: 'Login Kembali',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '/login';
        });
    },

    /**
     * Konfirmasi Logout
     * @returns {Promise}
     */
    confirmLogout() {
        return Swal.fire({
            title: 'Logout?',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: this.brandColor,
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        });
    },

    /**
     * Generic Error
     * @param {string} title - Judul error
     * @param {string} message - Pesan error
     * @returns {Promise}
     */
    error(title = 'Error!', message = 'Terjadi kesalahan') {
        return Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonColor: this.brandColor
        });
    },

    /**
     * Generic Success
     * @param {string} title - Judul sukses
     * @param {string} message - Pesan sukses
     * @returns {Promise}
     */
    success(title = 'Berhasil!', message = 'Operasi berhasil') {
        return Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            confirmButtonColor: this.brandColor,
            timer: 2000,
            timerProgressBar: true
        });
    }
};

if (typeof module !== 'undefined' && module.exports) {
    module.exports = SwalHelper;
}

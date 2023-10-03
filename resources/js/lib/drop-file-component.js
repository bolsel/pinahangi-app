export const dropFileComponent = (nama, wire) => {
  return {
    isDropping: false,
    isUploading: false,
    progress: 0,
    handleFileSelect(event) {
      if (event.target.files.length) {
        this.uploadFiles(event.target.files)
      }
    },
    handleFileDrop(event) {
      if (event.dataTransfer.files.length > 0) {
        this.uploadFiles(event.dataTransfer.files)
      }
    },
    uploadFiles(files) {
      const $this = this;
      this.isUploading = true
      wire.upload(nama, files[0],
        function (success) {
          $this.isUploading = false
          $this.progress = 0
        },
        function (error) {
          console.log('error', error)
        },
        function (event) {
          $this.progress = event.detail.progress
        }
      )
    },
    removeUpload(filename) {
      wire.removeUpload('file', filename);
    },
  }
}

<template>
    <div>
        <form enctype="multipart/form-data" @submit="formSubmit">
            <div class="columns is-mobile">
                <div class="column">
                    <label class="file-label">
                        <input class="file-input" type="file" name="file" @change="fileUpload">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name is-full">
                            {{ this.fileName }}
                        </span>
                    </label>
                </div>
                <div class="column is-one-quarter">
                    <button class="button is-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'InputFile',
    data: function () {
        return {
            fileName: 'No file choosen',
            file: '',
            success: ''
        }
    },
    methods: {
        fileUpload(event) {
            this.file = event.target.files[0];
            this.fileName = this.file.name;
        },
        formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
   
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('file', this.file);
   
                axios.post('/api/product/store', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                    if (response.data.status_code == 200) {
                       location.reload();
                    }
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
    }
}
</script>
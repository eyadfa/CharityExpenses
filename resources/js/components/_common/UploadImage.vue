<template>
    <div class="np-image-upload-picker" v-if="imageFile == null || imageFile.length == 0" >
        اختر صورة للتحميل:
        <input type="file"  @change="showImagePreview($event)" accept="image/*" />
    </div>
    <div class="np-image-preview" v-if="imageFile != null && imageFile.length != 0">
        <img class="np-preview" accept="image/*" :src="imageFile" />

    </div>
    <div class="d-flex flex-center" v-if="imageFile != null && imageFile.length != 0 && !isImageUploading">
        <button  class="btn btn-danger" v-on:click="clearImage" >
            ازالة
        </button>

    </div>

</template>


<script>

export default {
    name: "image",

    data(){
        return {
            loading:false,

            api_update:"/api/users/update/",
            imageFile: "https://png.pngtree.com/png-vector/20200614/ourlarge/pngtree-businessman-user-avatar-character-vector-illustration-png-image_2242909.jpg",
            isImageUploading: false,
        }
    },


    created() {

    },
    methods: {
        async submit() {
            const result = await this.v$.$validate()
            if (!result) {
                return;
            }

            if (this.$router.currentRoute.value.name === this.edit_route) {
                this.update();
            } else {
                this.add();
            }


        },
        update() {
            this.loading = true;
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(this.api_update+`${this.$route.params.id}`, this.form)
                    .then(response => {
                        this.form = response.data;
                        this.$swal('تم الحفظ بنجاح ');
                        this.$router.push({name: this.base_route})
                    })
                    .catch(function (error) {
                        console.error(error);
                    }).finally(() => {
                    this.loading = false
                });
            })
        },
        showImagePreview(event) {
            this.input = event.target;
            if (this.input.files && this.input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.imageFile = e.target.result;
                };
                reader.readAsDataURL(this.input.files[0]);
                this.$emit('input', this.input.files[0]);
            }
        },
        uploadImage() {
            this.isImageUploading = true;
            setTimeout(() => {
                console.log(this.imageFile);
                this.isImageUploading = false;
                this.clearImage();
                alert("Image uploaded sucessfully!");
            }, 3000);
        },
        upload(file, onUploadProgress) {
            let formData = new FormData();

            formData.append("file", file);

            return http.post("/upload", formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                },
                onUploadProgress
            });
        },
        clearImage() {
            this.imageFile = null;
            this.input = null;
        },

    },
}
</script>

<style scoped>
.np-image-preview {
    padding: 20px;
    background: #eee;
    border-radius: 16px;
    margin: 10px;
}

.np-image-upload-picker {
    padding: 20px;
    background: #eee;
    border-radius: 16px;
    margin: 10px;
}

img.np-preview {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px;
    height: 200px;
    border-radius: 16px;
    margin: 10px;
}
.np-upload-btn {
    margin: 10px;
    border: 0px !important;
    font-size: 18px;
    padding: 16px 60px !important;
    font-weight: 300;
    color: #fff;
    border-radius: 30px;
}

.np-upload-btn-confirm {
    background: rgb(0, 163, 73) !important;
}

.np-upload-btn-cancel {
    background: rgb(122, 0, 31) !important;
}

.np-upload-in-progress {
    background: #eee !important;
    margin: 10px;
    border: 0px !important;
    font-size: 18px;
    padding: 16px 60px !important;
    font-weight: 300;
    color: #000;
    border-radius: 30px;
}
</style>

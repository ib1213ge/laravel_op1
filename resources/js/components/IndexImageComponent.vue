<template>
    <div class="form-group row mx-1">
        <input type="file" class="w-100" style="font-size:12px" ref="file" name="picture" accept="image/*" @change="onFileChange" >
        <div class="alert alert-danger" v-if="error_picture">{{ error_picture }}</div>
        <button class="btn btn-secondary mt-3" @click="resetSelectImg" v-if="selectImg">画像リセット</button>
        <img :src="selectImg" class="w-100 h-100" style="object-fit: cover" alt="画像" v-if="selectImg">
    </div>
</template>

<script>
    export default {
       props: ['error_picture'],
       data: function() {
           return {
               selectImg: '',
           }
       },
       methods: {
         onFileChange: function(e) {
            const files = e.target.files;

            if(files.length > 0) {

                const file = files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.selectImg = e.target.result;
                };
                reader.readAsDataURL(file);
            }
          },
          resetSelectImg: function() {
              // 画像リセット
              const input = this.$refs.file;
              input.type = 'text';
              input.type = 'file';
              this.selectImg = '';
          }
        }
    }
</script>

<template>
    <div class="form-group row mx-1">
        <input type="file" class="w-100" style="font-size:12px" ref="file" name="picture" accept="image/*" @change="onFileChange">
        <div class="alert alert-danger" v-if="error_picture">{{ error_picture }}</div>
        <button class="btn btn-secondary mt-3" @click="resetSelectImg" v-if="selectImg">画像リセット</button>
        <button class="btn btn-secondary mt-3" @click="resetEditImg" v-if="editImg">画像を削除</button>
        <img :src="selectImg" class="w-100 h-100" style="object-fit: cover" alt="image" v-if="selectImg">
        <img :src="editImg" class="w-100 h-100" style="object-fit: cover" alt="image" v-if="editImg">
        <input type="hidden" name="edit_flg" :value="editImg">
    </div>
</template>

<script>
    export default {
       props: ['edit_picture', 'error_picture'],
       data: function() {
           return {
               selectImg: '',
               editImg: '',
           }
       },
       mounted() {
            if(this.edit_picture) {
                this.editImg = 'https://181417690029.signin.aws.amazon.com/console/' + this.edit_picture;
            }else{
                this.editImg = '';
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
            this.editImg = '';
          },
          resetSelectImg: function() {
              // 画像リセット
              const input = this.$refs.file;
              input.type = 'text';
              input.type = 'file';
              this.selectImg = '';
          },
          resetEditImg: function() {
              // 登録されている画像を削除
              const input = this.$refs.file;
              input.type = 'text';
              input.type = 'file';
              this.editImg = '';
          }
        }
    }
</script>

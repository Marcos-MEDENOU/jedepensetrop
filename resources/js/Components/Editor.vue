<template>
    <div>
      <vue-ckeditor 
        v-model="content" 
        :config="config" 
        @blur="onBlur($event)" 
        @focus="onFocus($event)"
        @contentDom="onContentDom($event)"
        @dialogDefinition="onDialogDefinition($event)"
        @fileUploadRequest="onFileUploadRequest($event)"
        @fileUploadResponse="onFileUploadResponse($event)" />
    </div>
</template>
  
  <script>
  import VueCkeditor from 'vue-ckeditor2';
  
  export default {
    components: { VueCkeditor },
    data() {
      return {
        content: '',
        config: {
          toolbar: [
            ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
          ],
          height: 300
        }
      };
    },
    methods: {
      onBlur(evt) {
      },
      onFocus(evt) {
      },
      onContentDom(evt) {
      },
      onDialogDefinition(evt) {
      },
      onFileUploadRequest(evt) {
      },
      onFileUploadResponse(evt) {
      }
    }
  };
  </script>
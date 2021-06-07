<template>
  <div class="container">
      <h3>{{ note.title }}</h3>
      <hr>
      <div class="mb-4">
          {{ note.published }} - {{ note.subject}}
      </div>
      
      <p>{{ note.description }}</p>
  </div>
</template>

<script>
export default {
    data(){
        return {
            note: []
        }
    },

    mounted(){
        this.getNote()
    },

    methods: {
        async getNote() {
            let {data} = await axios.get('/api/notes/' + this.$route.params.noteSlug)
            this.note = data.data
            
        }
    }
}
</script>
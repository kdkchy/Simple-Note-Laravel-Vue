<template>
  <div class="container">
      <h3 class="text-center">Table of Notes</h3>
      <table class="table">
          <thead>
              <tr class="">
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Description</th>
                  <th>Published</th>
                  <th>Act</th>
              </tr>
         </thead>
              <!-- <tr v-for="note in notes" :key="note.id">
                  <td><router-link :to="{ name: 'notes.show', params: {noteSlug: note.slug}}">{{ note.title }}</router-link></td>
                  <td>{{ note.subject }}</td>
                  <td>{{ note.description }}</td>
                  <td>{{ note.published }}</td>
              </tr> -->
            <tbody>
              <tr v-for="note in notes" :key="note.id" @click=ShowTheNote(note.slug)>
                  <td>{{ note.title }}</td>
                  <td>{{ note.subject }}</td>
                  <td>{{ note.description }}</td>
                  <td>{{ note.published }}</td>
              </tr>
            </tbody>
              
          
      </table>
  </div>
</template>

<script>
export default {
    data(){
        return {
            notes: []
        }
    },

    mounted() {
        this.getNotes()
    },

    methods: {
        async getNotes(){
            let {data} = await axios.get('/api/notes')
            this.notes = data.data
        },

        ShowTheNote(id) {
            this.$router.push({ name: 'notes.show', params: {noteSlug: id}});
        }
    }
}
</script>

<style>
tbody tr:hover {
    background-color:#f5f5f5;
    cursor: pointer;
}
</style>
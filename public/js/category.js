new Vue({
  el: '#category',
  data: {
    name: ""
  },
  methods: {
    onSubmit() {
      axios.post('/categories', this.data)
        .then(response => alert('Successfully Created!!!'));
    }
  }
});

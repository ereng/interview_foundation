<template>
<div>
  <b-button type="submit" v-on:click="login" variant="primary">Login</b-button>
</div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: 'aereng@test.local',
        password: 'Qwerty!0',
      },
      show: true
    }
  },
  methods: {
    login() {
      axios.post('/login', this.form).then(response => {
        localStorage.setItem('user-token', 'Bearer ' + response.config.headers['X-XSRF-TOKEN'])
        axios.defaults.headers.common['Authorization'] = localStorage.getItem('user-token');
        this.$router.replace('/')
      }).catch(error => console.log(error));
    }
  }
}
</script>
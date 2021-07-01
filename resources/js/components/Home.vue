<template>
<div>
  <b-form @submit="onSubmit" v-if="show" inline>
    <label class="mr-sm-2" for="inline-form-input-name">GitHub Token</label>
    <label class="mr-sm-2" v-if="tokenSaved" for="inline-form-input-name"> : {{form.git_hub_token}}</label>
    <b-form-input
      v-if="!tokenSaved"
      id="inline-form-input-name"
      v-model="form.git_hub_token"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder=""
    ></b-form-input>
    <b-button v-if="!tokenSaved" type="submit" variant="primary">Save</b-button>
  </b-form>
  <a
    v-if="showDocLink"
    href="https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token"
    target="_blank"
    class="card-link"
  >No Token? Click here to learn how to make a token</a>
  <StarredRipo v-if="tokenSaved" />
</div>
</template>
<script>
const StarredRipo = () => import("../components/StarredRipo");
export default {
  components: {
    StarredRipo
  },
  data() {
    return {
      form: {
        git_hub_token: '',
      },
      tokenSaved: false,
      stargazers:'',
      show: true,
      showDocLink: false
    }
  },
  created () {
    this.initialize()
  },
  methods: {
    initialize () {
      axios.get('/githubtoken').then(response => {
        if (response.data == 'no_token') {
          this.showDocLink = true;
        }else{
          this.form.git_hub_token = response.data;
          this.tokenSaved = true;
        }
      }).catch(error => {
        console.log(error)
      });
    },
    onSubmit(event) {
      event.preventDefault()
      axios.post('/githubtoken', this.form).then(response => {
        this.form.git_hub_token = response.data;
        this.showDocLink = false;
        this.tokenSaved = true;
      }).catch(error => {
        console.log(error)
      });
    }
  }
}
</script>
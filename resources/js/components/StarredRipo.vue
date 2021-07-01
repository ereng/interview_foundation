<template>
  <div>
    <b-toast id="bad-token-toast" title="Incorrect/Expired Github Token" static no-auto-hide>
      Enter a valid token and try again!
    </b-toast>
    <b-table striped hover :items="staredRipos" :fields="fields"></b-table>
    <b-button
      v-if="!gottenStaredRipos"
      v-on:click="getStaredRipos"
      :variant="gettingYourData ? 'gray' : 'primary'"
    >
      {{ gettingYourData ? 'Getting your data ...' : 'Get your stared repos' }}
    </b-button>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        gettingYourData: false,
        gottenStaredRipos: false,
        fields: ['full_name'],
        staredRipos: []
      }
    },
    methods: {
      getStaredRipos () {
        this.gettingYourData = true;
        axios.get('/getstaredripo').then(response => {
          console.log(response.data);
          this.staredRipos = response.data;
          this.gettingYourData = false;
          this.gottenStaredRipos = true;
        }).catch(error => {
          console.log(error.response);
          this.$bvToast.show('bad-token-toast');
        });
      }
    }
  }
</script>


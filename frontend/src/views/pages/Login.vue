<template>
  <div class="c-app flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol md="8">
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm @submit.prevent="login">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <CInputRadio inline type="radio" name="type" value="schools" label="Sekolah"
                    @input="type = $event.target.value" :checked="true" />
                  <CInputRadio inline type="radio" name="type" value="teachers" label="Guru"
                    @input="type = $event.target.value" />
                  <CInput v-if="type == 'schools'" type="email" placeholder="Email" autocomplete="email" v-model="email">
                    <template #prepend-content>
                      <CIcon name="cil-user" />
                    </template>
                  </CInput>
                  <CInput v-else type="text" placeholder="Email" autocomplete="Email" v-model="email">
                    <template #prepend-content>
                      <CIcon name="cil-user" />
                    </template>
                  </CInput>
                  <CInput placeholder="Password" type="password" autocomplete="curent-password" v-model="password">
                    <template #prepend-content>
                      <CIcon name="cil-lock-locked" />
                    </template>
                  </CInput>
                  <CRow>
                    <CCol col="6" class="text-left">
                      <CButton type="submit" color="primary" class="px-4">Login</CButton>
                    </CCol>
                    <CCol col="6" class="text-right">
                      <CButton color="link" class="px-0">Forgot password?</CButton>
                      <CButton color="link" class="d-lg-none">Register now!</CButton>
                    </CCol>
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
            <!-- <CCard
              color="primary"
              text-color="white"
              class="text-center py-5 d-md-down-none"
              body-wrapper
            >
              <CCardBody>
                <h2>Sign up</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <CButton
                  color="light"
                  variant="outline"
                  size="lg"
                >
                  Register Now!
                </CButton>
              </CCardBody>
            </CCard> -->
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      email: "",
      password: "",
      type: "schools"
    }
  },
  methods: {
    login() {
      this.axios.post("/login", {
        email: this.email,
        password: this.password,
        type: this.type
      }).then(response => {
        localStorage.setItem("ADMIN_PAGE_TOKEN", response.data.data.token)
        this.$store.dispatch('auth/authenticated', { token: response.data.data.token, as: response.data.data.as })
        this.$router.push({ name: "DashboardPage" })
      }).catch(e => {
        this.$swal({
          icon: 'error',
          title: 'Oops...',
          text: e.response.data.message,
        })
      })
    }
  }
}
</script>

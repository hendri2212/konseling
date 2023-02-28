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
                  <CInput type="text" placeholder="Email" autocomplete="Email" v-model="email">
                    <template #prepend-content>
                      <CIcon name="cil-envelope-closed" />
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
                    <!-- <CCol col="6" class="text-right">
                      <CButton color="link" class="px-0">Forgot password?</CButton>
                      <CButton color="link" class="d-lg-none">Register now!</CButton>
                    </CCol> -->
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
export default {
  name: 'AdminLogin',
  data() {
    return {
      email: "",
      password: "",
    }
  },
  methods: {
    login() {
      this.axios.post("login", {
        email: this.email,
        password: this.password,
        type: "admin"
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

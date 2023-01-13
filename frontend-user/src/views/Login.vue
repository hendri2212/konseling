<template>
    <layout-authentication>
        <h4 class="mb-2">Selamat Datang! 👋</h4>
        <form id="formAuthentication" class="mb-3" method="POST" @submit.prevent="login">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Masukkan nama pengguna anda" autofocus v-model="username" />
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                        <small>Lupa Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" v-model="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ingat-saya" />
                    <label class="form-check-label" for="ingat-saya"> Ingat Saya </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
            </div>
        </form>
    </layout-authentication>
</template>
<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import { mapActions } from 'pinia'
import { useAuthStore } from '../stores/auth'
import LayoutAuthentication from '../components/layout/LayoutAuthentication.vue'
export default {
    name: "Login",
    components: {
        LayoutAuthentication,
    },
    data() {
        return {
            url: import.meta.env.VITE_API_URL,
            username: "",
            password: "",
        }
    },
    methods: {
        ...mapActions(useAuthStore, ['authenticated']),
        async login() {
            try {
                if (this.username.trim() == "" || this.password.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Upss...',
                        text: "Username dan password wajib diisi",
                    })
                    return;
                }

                let payload = {
                    username: this.username,
                    password: this.password
                }

                const { data } = await axios.post(`${this.url}/login`, payload)
                this.authenticated(data.data.token)
                this.$router.push({ name: "Dashboard" })
            } catch (e) {
                if (e.name == "AxiosError") {
                    let { message } = e.response.data
                    Swal.fire({
                        icon: 'error',
                        title: 'Upss...',
                        text: message,
                    })
                } else {
                    console.log(e)
                    console.log(`Client side error! : ${e}`)
                }
            }
        },
    }
}
</script>
<template>
    <div class="row" v-if="loaded">
        <div class="card mb-3">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                                </li>
                                <li v-if="$route.name == 'Angket'" class="breadcrumb-item active">{{ name }}</li>
                                <li v-if="$route.name == 'AttemptSummary' || $route.name == 'Attempt' || $route.name == 'AttemptReview'" class="breadcrumb-item">
                                    <router-link :to="{ name: 'Angket', query: { id: $route.query.id } }">{{ name }}</router-link>
                                </li>
                                <li v-if="$route.name == 'Attempt'" class="breadcrumb-item active">Pengerjaan angket</li>
                                <li v-if="$route.name == 'AttemptReview'" class="breadcrumb-item active">Ulasan pengerjaan angket</li>
                                <li v-if="$route.name == 'AttemptSummary'" class="breadcrumb-item active">Rangkuman pengerjaan angket</li>

                            </ol>
                        </nav>
                        <h3 class="text-primary mb-0">{{ name }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <router-view :id="$route.query.id" :token="token"></router-view>
    </div>
</template>
<script>
import { mapActions } from 'pinia'
import { useAttemptStore } from '@/stores/attempt'
export default {
    name: "AngketParent",
    props: {
        token: String
    },
    data() {
        return {
            error: false,
            message: "",
            loaded: false,
            name: ""
        }
    },
    async created() {
        if (!this.$route.query.id) {
            this.error = true
            this.message = "Parameter yang dibutuhkan (id) tidak ada"
            return;
        }
        if (this.$route.query?.id.trim() == '') {
            this.error = true
            this.message = "ID angket tidak valid"
            return;
        }

        this.setSurveyId(this.$route.query.id.trim())

        try {
            const { data } = await this.axios.get(`surveys/${this.$route.query.id.trim()}`, {
                headers: {
                    Authorization: `Bearer ${this.token}`
                }
            })
            this.name = data.data.name
        } catch (e) {
            this.error = true
            if (e.name == "AxiosError") {
                let { message } = e.response.data
                this.message = message
            } else {
                this.message = `Client side error! : ${e}`
            }
        } finally {
            this.loaded = true
        }
    },
    methods: {
        ...mapActions(useAttemptStore, ['setSurveyId']),
    }
}
</script>
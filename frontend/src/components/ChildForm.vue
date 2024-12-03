<template>
    <ul :style="level == 1 ? 'padding-left:0;' : ''">
        <li>
            <div>
                <div class="d-flex align-items-center pb-1">
                    <div :class="{ 'px-2 border-top': level > 1 }"></div>
                    <div @click="someEmitRemove()">
                        <CIcon class="text-danger mr-2" name="cil-x" />
                    </div>
                    <input type="text" class="form-control font-weight-light" :value="dynamic_form.value"
                        @change="(el) => someEmitEdit(el.target.value)" />
                    <button v-if="level < 3" @click="someEmitAddChild()"
                        class="input-group-text bg-success text-white text-bold button-add">
                        <CIcon name="cil-plus" class="text-white" />
                    </button>
                </div>
            </div>
            <ul v-if="dynamic_form.child.length > 0" class="border-left">
                <child-form v-for="(child, key) in dynamic_form.child" :dynamic_form="child" :my_key="key"
                    :level="level + 1" :key="`child_${key}`" @emit_remove_from_child="reactEmitRemove"
                    @emit_edit_from_child="reactEmitEdit" @emit_add_child_from_child="reactEmitAddChild"></child-form>
            </ul>
        </li>
    </ul>
</template>
<script>
export default {
    name: "ChildForm",
    props: {
        dynamic_form: Object,
        my_key: Number,
        level: Number,
    },
    methods: {
        someEmitRemove() {
            let array_of_key = []
            array_of_key.push(this.my_key)
            this.$emit('emit_remove_from_child', array_of_key)
        },
        someEmitEdit(value) {
            let array_of_key = []
            array_of_key.push(this.my_key)
            this.$emit('emit_edit_from_child', array_of_key, value)
        },
        someEmitAddChild() {
            let array_of_key = []
            array_of_key.push(this.my_key)
            this.$emit('emit_add_child_from_child', array_of_key)
        },
        reactEmitRemove(array_of_key) {
            array_of_key.push(this.my_key)
            this.$emit('emit_remove_from_child', array_of_key)
        },
        reactEmitEdit(array_of_key, value) {
            array_of_key.push(this.my_key)
            this.$emit('emit_edit_from_child', array_of_key, value)
        },
        reactEmitAddChild(array_of_key) {
            array_of_key.push(this.my_key)
            this.$emit('emit_add_child_from_child', array_of_key)
        },
    }
}
</script>
<style scoped>
ul {
    list-style: none;
    padding-left: 10px;
}

li:hover>div div button {
    display: block;
}

.button-add {
    display: none;
}
</style>
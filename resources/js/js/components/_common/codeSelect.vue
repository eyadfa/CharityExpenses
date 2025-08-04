<template>
    <div class="fv-row">
        <label v-if="display_title" class="fs-5 fw-bold mb-2" :class="is_required?'required':''">{{title}}</label>
        <label v-if="display_title" class="text-muted mb-2" > كود {{main_cd}}</label>
        <select :disabled="is_disabled" v-model="selectedCode" class="form-select form-select-solid"  >
            <option v-if="is_searchable" value="-1">الكل</option>
            <option v-for="c in codes" :key="c.id" :value="c.sub_cd">{{c.desc_ar}}</option>
        </select>
    </div>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
    props:{
        sub_cd:{
            type:Number
        },
        main_cd:{
            type:Number
        },
        title:{
            type:String
        },
        is_required: {
            type: Boolean,
            default: true
        },
        is_searchable: {
            type: Boolean,
            default: false
        },
        is_disabled: {
            type: Boolean,
            default: false
        },
        display_title:{
            type: Boolean,
            default: true
        }
    },
    emits: ['update:sub_cd'],
    data() {
        return {
            selectedCode: this.sub_cd || 0,
        }
    },
    setup() {
        const store = useStore();
        let serverData;
        serverData = computed(() => store.state.serverData);

        return {
            serverData,
        };
    },
    mounted() {
        // Emit initial values to parent
        this.$emit('update:sub_cd', this.selectedCode);
    },
    computed: {
        codes() {
            if (this.serverData && this.main_cd !== undefined) {
                return this.serverData['_' + this.main_cd] || [];
            } else {
                return [];
            }
        }
    },
    watch:{
        sub_cd(newValue) {
            this.selectedCode = newValue;
        },
        selectedCode(newValue) {
            this.$emit('update:sub_cd', newValue);
        },
    }
};
</script>



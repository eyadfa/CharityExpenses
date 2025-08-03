<template>
<div class="row">
    <div class="col-md-6 fv-row">
        <label class=" fs-5 fw-bold mb-2" :class="is_required?'required':''">  {{sCountryTitle}} </label>
        <select @change="loadCities" v-model="selectedCountry" class="form-select form-select-solid">
            <option v-if="is_searchable" value="-1">الكل</option>
            <option  v-for="c in countries" :value="c.id" :key="c.id">{{ c.name}}</option>
        </select>
    </div>

    <div class="col-md-6 fv-row">
        <label class="fs-5 fw-bold mb-2" :class="is_required?'required':''"> {{sCityTitle}}  </label>
        <select v-model="selectedCity" class="form-select form-select-solid">
            <option v-if="is_searchable" value="-1">الكل</option>
            <option v-for="c in cities" :value="c.id" :key="c.id">{{ c.name}}</option>
        </select>
    </div>
</div>
</template>

<script>
import shared from "../../src/shared";

export default {
    name: "countryCity",
    props: {
        country: {
            type: Number
        },
        city: {
            type: Number,
            default:0
        },
        countryTitle: {
            type: String
        },
        cityTitle: {
            type: String
        },
        is_searchable: {
            type: Boolean,
            default: false
        },
        is_required: {
            type: Boolean,
            default: true
        }
    },
    emits: ['update:country', 'update:city'],
    data() {
        return {
            countries:[],
            cities:[],
            selectedCountry: this.country || 0,
            selectedCity: this.city || 0,
            sCityTitle: this.cityTitle|| 'المدينة',
            sCountryTitle: this.countryTitle|| 'الدولة',
            is_first:true,
        }
    },
    async created() {
        this.countries = await shared.countries();
    },
    methods: {
        async loadCities() {
            var country = this.country;
            this.cities = await shared.cities(country);
        },
    },

    mounted() {
        // Emit initial values to parent
       // this.$emit('update:country', this.selectedCountry);
       // this.$emit('update:city', this.selectedCity);
    },
    watch:{
        country(newValue) {
            this.selectedCountry = newValue;
            this.selectedCity= this.city;
            this.loadCities();
        },
        city(newValue) {
            this.selectedCity = newValue;
        },
        selectedCountry(newValue) {
            if(!this.is_first){
                this.selectedCity = 0;
            }
            this.is_first=false
            this.$emit('update:country', newValue);
            this.$emit('update:city', this.selectedCity);
        },
        selectedCity(newValue) {
            this.$emit('update:city', newValue);
        }
    }
}
</script>



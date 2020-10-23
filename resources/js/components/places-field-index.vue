<template>
    <div>
        <div class="flex items-center" v-if="value">
            {{ value.name }}
            <a class="ml-1" :href="mapLink">→</a>
        </div>
    </div>
</template>

<script>
export default {
    mixins: [IndexFieldtype],
    computed: {
        mapLink() {
            return `https://www.openstreetmap.org/search?query=${this.value.value}`;
        }
    }
};
</script>

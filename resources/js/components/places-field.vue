<template>
    <div>
        <div
            class="bg-red-lighter p-3 text-sm text-red"
            v-if="error.key || error.id"
        >
            <span v-html="__('Be sure to add the following environment variables to your .env')"></span>
            <ul class="mt-1 list">
                <li v-if="error.key">
                    <code>PLACES_API_KEY</code>
                </li>
                <li v-if="error.id">
                    <code>PLACES_APP_ID</code>
                </li>
            </ul>
        </div>
        <input
            v-else
            :placeholder="config.placeholder"
            class="input-text"
            ref="inputRef"
            :value="inputValue"
        />
    </div>
</template>

<script>
import places from "places.js";

export default {
    mixins: [Fieldtype],
    data() {
        return {
            error: {
                key: !this.meta.placesApiKey,
                id: !this.meta.placesAppId
            }
        };
    },
    computed: {
        inputValue() {
            return this.value ? this.value.value : '';
        }
    },
    methods: {
        handleAddressSelect(e) {
            delete e.suggestion.rawAnswer;
            delete e.suggestion.hit;
            delete e.suggestion.hitIndex;
            delete e.suggestion.highlight;

            this.update(e.suggestion);
        }
    },
    mounted() {
        const { error } = this;
        const { placesApiKey, placesAppId } = this.meta;
        if (error.key || error.id) {
            return;
        } else {
            const options = {
                appId: placesAppId,
                apiKey: placesApiKey,
                container: this.$refs.inputRef,
                postcodeSearch: !!this.config.postcodeSearch,
                getRankingInfo: !!this.config.getRankingInfo,
                useDeviceLocation: !!this.config.useDeviceLocation,
            };

            if (this.config.searchType !== 'all') {
                options.type = this.config.searchType;
            }

            if (this.config.language) {
                options.language = this.config.language;
            }

            if (this.config.countries) {
                options.countries = this.config.countries;
            }

            switch (this.config.locationSearch) {
                case 'lat_lng':
                    options.aroundLatLng = this.config.aroundLatLng;
                    break;
                case 'lat_lng_ip':
                    options.aroundLatLngViaIP = true;
                    break;
                case 'bounding_box':
                    options.insideBoundingBox = this.config.insideBoundingBox;
                    break;
                case 'polygon':
                    options.insidePolygon = this.config.insidePolygon;
                    break;
            }

            const placesInstance = places(options);
            placesInstance.on("change", this.handleAddressSelect);
        }
    }
};
</script>

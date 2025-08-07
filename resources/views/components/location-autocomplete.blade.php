@props(['value' => ''])

<div class="mt-4" x-data="locationAutocomplete('{{ old('location_name', $value) }}')">
    <x-input-label for="location_name" :value="__('Location')" />
    <input
        id="location_name"
        name="location_name"
        type="text"
        placeholder="Enter your location"
        x-model="search"
        x-on:input.debounce.500ms="fetchSuggestions"
        x-on:focus="showSuggestions = true"
        class="block mt-1 w-full"
        autocomplete="off"
        @click.away="showSuggestions = false"
        required
    />

    <!-- Suggestions Dropdown -->
    <ul
        x-show="showSuggestions && suggestions.length"
        class="border bg-white shadow absolute z-50 w-full mt-1 max-h-48 overflow-auto text-sm"
    >
        <template x-for="(item, index) in suggestions" :key="index">
            <li
                x-text="item.display_name"
                class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                @click="selectSuggestion(item)"
            ></li>
        </template>
    </ul>

    <!-- Hidden fields to store lat/lng -->
    <input type="hidden" name="latitude" :value="latitude">
    <input type="hidden" name="longitude" :value="longitude">

    <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
</div>

<script>
function locationAutocomplete(initSearch = '') {
    return {
        search: initSearch,
        latitude: '',
        longitude: '',
        suggestions: [],
        showSuggestions: false,

        async fetchSuggestions() {
            if (this.search.length < 3) {
                this.suggestions = [];
                return;
            }

            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.search)}&addressdetails=1&limit=5`);
            this.suggestions = await response.json();
        },

        selectSuggestion(item) {
            this.search = item.display_name;
            this.latitude = item.lat;
            this.longitude = item.lon;
            this.showSuggestions = false;
        }
    }
}
</script>
<template>
    <div>
        <div class="mb-2">
            <form>
                <div class="control">
                    <input class="input" type="text" name="q" v-model="search" placeholder="Search">
                </div>
            </form>
        </div>
        <div class="columns">
            <div class="column">
                <table class="table is-striped">
                    <thead>
                        <tr>
                            <th v-for="column in columns">{{ column }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in list">
                            <td>{{ row['id'] }}</td>
                            <td>{{ row['type'] }}</td>
                            <td>{{ row['brand'] }}</td>
                            <td>{{ row['model'] }}</td>
                            <td>{{ row['capacity'] }}</td>
                            <td>{{ row['quantity'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            columns: ['Product ID', 'Types', 'Brand', 'Model', 'Capacity', 'Quantity'],
            list: [],
            search: ''
        }
    },
    mounted() {
        this.fetchList();
    },
    methods: {
        async fetchList(val = '') {
            const response = await axios.get('/api/products?q=' + val);
            this.list = response.data;
        }
    },
    watch: {
        'search': {
            handler: function (val) {
                this.fetchList(val);
            },
            deep: true
        }
    },
}
</script>

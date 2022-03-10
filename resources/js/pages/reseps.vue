<template>
<div>
    <div class="container mt-2">
        <div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3>
                        Riwayat Resep
                    </h3>
                    <div class="card-tools ml-auto ">
                        <div class="input-group input-group-sm">
                          <!-- Button New -->
                            <router-link :to="{ name: 'CreateResep' }"  class="btn btn-success">
                                <i class="fas fa-calendar-plus"></i> Buat Resep Baru
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table w-100" id="adminArticleTable" v-if="reseps">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kode Resep</th>
                                <th scope="col">Pasien</th>
                                <th scope="col">Dokter</th>
                                <th scope="col">Poli</th>
                                <th >Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(d, index) in reseps" :key="index">
                                <td>{{ d.created_date }} </td>
                                <td>{{ d.resep_kode }} </td>
                                <td>{{ d.patient }}</td>
                                <td>{{ d.doctor }}</td>
                                <td>{{ d.poli }}</td>
                                <td>
                                    <router-link :to="{ name: 'ShowResep', params: { id: d.id } }"    class="btn btn-sm btn-success">
                                        <i class="fas fa-print text-success"/> Cetak
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>
</template>

<script>

export default {
    data() {
      return {
        reseps:{},
      }
    },

    computed: {
        endpoint() {
            return `api/resep`;
        },
    },

    mounted(){
        axios.get(this.endpoint)
        .then((response)=>{
            this.reseps = response.data;
        })
    },

};

</script>

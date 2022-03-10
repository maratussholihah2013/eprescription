<template>
    <div class="container mt-2">
        <div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 >Riwayat Resep</h3>
                </div>
                <div class="card-body" id="printMe">
                    <table class="table table-striped" v-if="resep">
                      <tbody>
                        <tr>
                          <th class="col col-2">Pasien</th>
                          <td>{{resep.patient}}</td>
                        </tr>
                        <tr>
                          <th>Dokter</th>
                          <td>{{resep.doctor}}</td>
                        </tr>
                        <tr>
                          <th>Poli</th>
                          <td>{{resep.poli}}</td>
                        </tr>
                        <tr>
                          <th>Kode Resep</th>
                          <td>{{resep.resep_kode}}</td>
                        </tr>
                        <tr>
                          <th>Detail Resep Obat </th>
                          <td></td>
                        </tr>
                        <tr>
                          <th></th>
                          <td>                                
                            <div class="card">
                                <div class="card-body">
                                    <table class="table w-90">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Jenis</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">Signa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(d, index) in resep.detail_reseps' :key='index'>
                                                <td>{{index+1}}</td>
                                                <td v-if="d.jenis_racikan == 0"> Non Racikan</td>
                                                <td v-else> Racikan</td>
                                                <td >{{ d.nama_racikan }}<br v-show="d.jenis_racikan==1">
                                                    <small v-for = '(r,i) in d.detail_racikans' :key='i'>
                                                        {{ r.obatalkes.obatalkes_kode }} - {{ r.obatalkes.obatalkes_nama }} | Qty : {{ r.quantity }} <br>
                                                    </small>
                                                </td>    
                                                <td>{{ d.signa.signa_kode }} - {{ d.signa.signa_nama }} </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </td>
                        </tr>
                      </tbody> 
                    </table>
                </div>
                <div class="card-footer  text-center">
                    <button class="btn btn-success" v-print="'#printMe'">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import dependency print for button print
import print from 'vue3-print-nb'

export default {
    directives:{ print },

    props:['id'],

    data() {
      return {
        resep:{},
      }
    },

    computed: {
        endpoint() {
            return `../api/resep/${this.id}`;
        },
    },

    mounted(){
        this.getData();
    },

    methods: {
        getData() {
            axios.get(this.endpoint)
                .then((response)=>{
                    this.resep = response.data
                })
                .catch(e => {
                   console.log(e.response);
                    swal.fire({
                        title: 'Oops !',
                        text:   e.response.data.message,
                        icon: 'warning',
                    });
                });
        },


    },
};

</script>

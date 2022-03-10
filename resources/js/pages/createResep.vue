<template>
    <div class="container mt-2">
        <div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 >Pembuatan Resep Baru</h3>
                </div>
                <div class="card-body">
                  <form @submit.prevent="submitData()">
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
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#exampleModal" @click.prevent="showModal"><i class="fas fa-calendar-plus"></i> Tambahkan detail resep obat</button></td>
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
                                                <th >Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(d, index) in resep.detailResep' :key='index'>
                                                <td>{{index+1}}</td>
                                                <td>{{ d.jenis_ejaan }}</td>
                                                <td >{{ d.nama_racikan }}<br v-show="d.jenis_racikan==1">
                                                    <small v-for = '(r,i) in d.detailRacikan' :key='i'>
                                                        {{ r.obatalkes_ejaan }} | Qty : {{ r.quantity }} <br>
                                                    </small>
                                                </td>    
                                                <td>{{ d.signa_ejaan }}</td>  
                                                <td>
                                                    <button class="btn btn-sm btn-link" @click.prevent="deleteDetail(index)">
                                                        <i class="fas fa-trash  text-danger"/>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>                      
                        <tfoot>
                            <tr>
                                <th></th>
                                <td class="modal-footer d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                  </form>
                </div>
            </div>
            <!-- Modal containing dynamic form for adding/updating data details. -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <!-- Show/hide headings dynamically based on /isFormCreateMode value (true/false) -->
                    <h5 v-show="isFormCreateMode" class="modal-title" id="exampleModalLabel">Menambahkan detail resep baru</h5>
                    <h5 v-show="!isFormCreateMode" class="modal-title" id="exampleModalLabel">Mengubah detail resep baru</h5>
                  </div>
                  <!-- Form for adding/updating user details. When submitted call /createData() function if /isFormCreateMode value is true. Otherwise call /updateData() function. -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Racikan</label>
                            <select class='form-control' v-model='form.jenis_racikan' @change="form.count_racikan=1" required>
                                <option value='1'>Racikan</option>
                                <option value='0'>Non Racikan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Detail obat</label>
                            <button class="btn btn-sm btn-link" @click.prevent="form.count_racikan++"  v-show="form.jenis_racikan == 1">
                                    <i class="fas fa-plus  text-success"/> Tambah racikan
                                </button>
                            
                            <detailracikan ref="dracikan" v-if="form.jenis_racikan != 1" :obatList="obats" />
                            <detailracikan ref="dracikan" v-else :obatList="obats" v-for="i in form.count_racikan" :index="i"/>
                        </div>
                        <div class="form-group">
                            <label>Signa</label>
                            <v-select v-model="form.signa_id" :getOptionLabel="(option) => `${option.signa_kode} - ${option.signa_nama}`" :options="signas" :reduce="(option) => option.id" placeholder="Pilih signa" @option:selected="optionSelected" ></v-select>
                        </div>
                        <div class="form-group" v-show="form.jenis_racikan == 1">
                            <label>Nama Racikan</label>
                            <input v-model='form.nama_racikan' type="text" name="name" class="form-control" placeholder="Nama" aria-label="name" aria-describedby="basic-addon1" />                           
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button @click.prevent="addDetailResep()" class="btn btn-primary" v-show="isFormCreateMode">Tambahkan</button>
                    </div>
                </div>
              </div>
            </div> 
        </div>
    </div>
</template>

<script>
import detailracikan from '../components/detailracikan.vue';

export default {
    components: {detailracikan},
    data() {
      return {
        obats:[],
        signas:[],
        resep:{
            resep_kode:'ABC-123-XYZ',
            patient:'Hardin Noal',
            doctor:'Prof. Sujono',
            poli:'Bedah Toraks',
            detailResep:[
            ],
            
        },
        form:{
            count_racikan:1,
            signa_id:null,
            jenis_racikan:null,
            nama_racikan:null,
        },
        isFormCreateMode:true,
        selectedSigna:null,
      }
    },

    computed: {
        endpoint() {
            return `api/resep`;
        },
    },

    mounted(){
        this.getData();
    },

    methods: {
        getData() {
            axios.get(`api/indexcreate`, {})
                .then((response)=>{
                    this.obats = response.data.obats;
                    this.signas = response.data.signas; 
                });
        },

        optionSelected(option) {  
            this.selectedSigna = option.signa_kode+" - "+option.signa_nama;
        },

        addDetailResep(){
            //temporary variable untuk detail racikan
            var dra = [];  
            //untuk menyimpan label dari jenis racikan yang dipilih
            var jenis_ejaan = "Racikan";
            //jika jenis racikannya 'Racikan' maka loop ref dracikan untuk mendapatkan array id obat dan qty yg tersimpan di element/tag detailracikan
            //obatalkes_ejaan untuk menyimpan label dari obat -> untuk ditampilkan di tabel agar user friendly
            if(this.form.jenis_racikan==1)
                this.$refs.dracikan.forEach((element) => {                
                   dra.push(
                       {
                            "obatalkes_id" : element.selectedObat,
                            "obatalkes_ejaan" : element.selectedEjaan,
                            "quantity" : element.qty,
                        }
                    );
                });
            //jika jenis racikan != 1 maka jenis ejaannya menjadi Non Racikan
            //lalu menyimpan detail racikan (1 obat dan qty-nya) dari ref dracikan tanpa loop
            else{
                jenis_ejaan = "Non Racikan";
                dra.push(
                   {
                        "obatalkes_id" : this.$refs.dracikan.selectedObat,
                        "obatalkes_ejaan" : this.$refs.dracikan.selectedEjaan,
                        "quantity" : this.$refs.dracikan.qty,
                    }
                );
            }

            //menyimpan data detail resep dan detail racikan ke variable resep
            this.resep.detailResep.push(
                {
                    "jenis_racikan" : this.form.jenis_racikan,
                    "jenis_ejaan" : jenis_ejaan,
                    "nama_racikan" : this.form.nama_racikan,
                    "signa_id" : this.form.signa_id,
                    "signa_ejaan" : this.selectedSigna,
                    "detailRacikan" : dra,
                }
            );

            //membersihkan form ke nilai default
            this.form.count_racikan=1;
            this.form.signa_id=null;
            this.form.jenis_racikan=null;
            this.form.nama_racikan=null;
            //menyembunyikan modal
            $('#exampleModal').modal('hide'); 

        },

        showModal() {
            this.isFormCreateMode = true;
            $('#exampleModal').modal('show'); 
        },

        deleteDetail(index){
            swal.fire({
                title:'Are you sure?',
                text:'This action will delete data permanently',
                icon:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value){
                    this.resep.detailResep.splice(index,1);
                    swal.fire('Deleted!',
                                'Your data has been deleted',
                                'success'
                            );
                }
            });
        },

        submitData(){
            axios.post(this.endpoint, this.resep,{
                headers:{'Content-Type':'application/json'
                        }
            })
            .then((res) => {
                console.log(res.data);
                swal.fire({
                    icon:'success',
                    title:'Data resep created successfully'
                })
            })
            .catch(e => {
               console.log(e.response);
                swal.fire({
                    title: 'Oops !',
                    text:   e.response.data.message,
                    icon: 'warning',
                });
            });
        }

    },
};

</script>

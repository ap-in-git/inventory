<template lang="html">
   <span>

     <div class="white-box">



      <v-pagination ref="pagination"
       @vuetable-pagination:change-page="onChangePage"
       class="pull-right"

    ></v-pagination>
    <v-table ref="vuetable"
      :api-url="url"
      :fields="fields"
        pagination-path=""
        :css="css.table"
        per_page=40

      @vuetable:pagination-data="onPaginationData"

    ></v-table>



     </div>
   </span>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable';
    import VuetablePaginationBootstrap from '../components/VuePaginationBootstrap.vue'
    import CssConfig from '../components/VuetableCssConfig'
    export default {
        components:{
          'v-table':Vuetable,
            'v-pagination':VuetablePaginationBootstrap
        },
        data() {
            return{
                fields:[
                    {
                        name:'product_name',
                        title:'Name'
                    },
                    {
                       name:'size',
                        title:'Size'
                    },
                    {
                       name:'quantity',
                      title:'Quantity'
                    },
                    {
                        name:'code',
                        title:'Code'
                    },
                    {
                        name:'user_name',
                        title:'HBW Name'
                    },
                    {
                      name:'bought_price',
                        title:'Bought Price(Npr)'
                    },
                    {
                        name:'sold_price',
                        title:'Sold Price(Npr)'
                    }
                ],
                 url:'/inventory/sell-history',
                css:CssConfig,

            }
        },
        methods:{
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            onAction (action, data, index) {
                if(action=='edit-item')
                    this.approveDeck(data.id)

                if(action=="delete-item")
                    this.deleteDeck(data.id);

            },
        },
        mounted() {
            axios.get("/inventory/sell-history").then((data)=>{

            })

        }
    }
</script>

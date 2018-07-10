<template lang="html">
 <div v-cloak>
   <ul class="list-group">
     <span v-for="category in categories">
     <li class="list-group-item" @click="showSub(category.id)">{{category.name}}
         <i :class="currentCategory==category.id?'fa fa-arrow-up':'fa fa-arrow-down'">     </i>
</li>
     <ul class="list-group" v-if="currentCategory==category.id">

       <li :class="currentSub==cat.id?'list-group-item active color-white p-l-5':'list-group-item p-l-5' " v-for="cat in category.subcategories"><a :href="'/products?sub='+cat.id+'&sort='+sort">{{cat.name}}</a></li>

     </ul>
      </a>
      </a>
     </span>

   </ul>


  </div>
</template>

<script>
export default {
  props: ['sub_id','sort'],

  data() {
    return {
      categories: [],
      currentCategory: null,
      currentSub:null

    }


  },

  methods: {
    showSub(id) {

      if (this.currentCategory == id) {
        this.currentCategory = null;
        return;
      }
      this.currentCategory = id;

    },
    findSub()
    {
     if(this.sub_id===0)
     return;

    let selected_category=0;
    for (let i = 0; i < this.categories.length; i++) {
      let subcategories=this.categories[i].subcategories;
      for(let j=0;j<subcategories.length;j++){
         if(subcategories[j].id==this.sub_id)
          {
          selected_category=this.categories[i].id;
          this.currentSub=subcategories[j].id;
            break;
          }
      }

    }
    if(this.selected_category==0){
      return;
    }else{
      this.currentCategory=selected_category;
      console.log(this.currentCategory);
    }


    }
  },
  mounted() {


    axios.get("/categories").then((response) => {
      this.categories = response.data;
       this.findSub();

    })


  }
}
</script>
<style type="text/css">
.p-l-5 {

  padding-left: 30px;
}

.color-white>a{
  color:white !important;
}
</style>

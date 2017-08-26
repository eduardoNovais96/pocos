<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="foto"> </div>
<script>
            token = 'EAACEdEose0cBAAmpaICphS3NQPdhfmT2v6c6TAsB94cCbFV3rZAUzp4ntNtwLJRY0CAnqvzZBCEWmMdiBscET8RjddepXi9plfKJwNJEqSkMppmmvVXp2HfFMiO0ieQ9y4oUYaDw11cAFpZCyFsoFWwgGyDPmtJBuoRGXpEag6v6tkLBAVai0uEx3mEiW8fmVK2ZBdtXpgZDZD';
           
            axios.get('https://graph.facebook.com/search',{
              params:{
                q:'sm coaching',
                type: 'page',
                access_token:token
              }
          }).then(function(response){
                console.log(response);
                console.log(response.data.data[0].id);
                info(response.data.data[0].id);
               // image(response.data.data[0].id);
                //for
            }); 
            
            /* function image(id){
                axios.get('https://graph.facebook.com/'+id+'/picture',{
                    params:{
                    type:'large',
                    access_token:token
                    }
                }).then(function(response){
                    console.log(response);
                    document.getElementById("foto").innerHTML = '<img src="'+response.data.picture.data+'">'
                });
            }; */
            
    
            function info(id){
                axios.get('https://graph.facebook.com/'+id,{
                    params:{
                    fields:'overall_star_rating,name,bio,about,emails,picture.type(large),website',
                    access_token:token
                    }
                }).then(function(response){
                    ///console.log(response);
                    console.log(response.data.about);
                    console.log(response.data.name);
                    console.log(response.data.overall_star_rating);
                    console.log(response.data.email);
                    console.log(response.data.website);
                    console.log(response);
                    document.getElementById("foto").innerHTML = '<img src="'+response.data.picture.data.url+'">'

                //for
                });
            };
</script>
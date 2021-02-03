/* =============================================================================
                               Variables
============================================================================= */


const imageForm = document.getElementById('image-form');


/* =============================================================================
                             Event Listeners
============================================================================= */


imageForm.addEventListener('submit', async function(e){
  e.preventDefault();

  const image = this.elements.image.files[0];

  if (!image){
    alert("You must select an image prior to submitting.");
    return;
  }

  const encodedImage = await toBase64(image);
  const json         = { image: encodedImage, imageName: image['name'] };


  postData('php/save_image.php', json)
  .then(res  => {
    if (res.data.result === "SUCCESS"){
      this.reset();
      console.log(res.data);
    } else if (res.data.result === "FAIL"){
      console.error(res.data.message);
    }
  })
  .catch(err => { console.error(err); });
});


/* =============================================================================
                             Initialization
============================================================================= */

// ...

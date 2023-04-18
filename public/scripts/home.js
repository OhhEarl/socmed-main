let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
const textArea = document.querySelector('#user_text_input');
const postHere = document.querySelector('#postHere');



const createPost = () =>{
    fetch("/insertPost/"+textArea.value,{
        method: "GET",
        header: {
            "Content-Type": "text/html",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        }
    }).then(res => res.text())
    .then(response =>{
        postHere.innerHTML = response
        textArea.value = '';
    }).catch(err =>{
        console.log(err);
    })
}






// let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
// const textArea = document.querySelector('#user_text_input');
// const postHere = document.querySelector('#postHere');

// const createPost = () =>{
//   postHere.innerHTML = 'Loading Content..';
//   fetch("/insertPost/"+textArea.value,{
//     method: "GET",
//     header: {
//       "Content-Type": "text/html",
//       "X-Requested-With": "XMLHttpRequest",
//       "X-CSRF-TOKEN": token
//     }
//   }).then(res => res.text())
//   .then(response => {
//     postHere.innerHTML = response
//     textArea.value = '';
//   })
//   .catch(err => {
//     console.log(err);
//   });
// }

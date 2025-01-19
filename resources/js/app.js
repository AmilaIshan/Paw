import './bootstrap';

window.addEventListener('guest', (event) => {
    let data = event.detail;

    Swal.fire({
      icon: data.type,
      iconColor: '#ff2424',
      title: data.message,
      showCancelButton: true,
      confirmButtonText: "Login",
      confirmButtonColor: '#ffd022',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/login';
        }
    });
});

// window.addEventListener('removeFromcart', (event) => {
//     let data = event.detail;
//     console.log(data);
//     Swal.fire({
//         icon: data.title,
//         iconColor: '#ff2424',
//         title: data.message,
//         showCancelButton: true,
//         confirmButtonText: "Remove",
//         confirmButtonColor: '#ffd022',
//       }).then((result) => {
//           if (result.isConfirmed) {
//             // Livewire.dispatch('remove-from-cart');
//             Livewire.emit('remove-from-cart', { itemId: data.itemId });
//           }
//       });
// });

window.addEventListener('add-to-cart', (event) => {

    let data = event.detail;

    Swal.fire({
        position: 'top-end',
        icon: data.title,
        iconColor: '#35ff11',
        title: data.message,
        showConfirmButton: false,
        toast: 'top-end',
        timer: 3500
      }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '/cart';
          }
      });
});

window.addEventListener('remove-from-cart', (event) => {

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        iconColor: '#35ff11',
        title: 'Item removed from cart',
        showConfirmButton: false,
        toast: 'top-end',
        timer: 3500
      });
});
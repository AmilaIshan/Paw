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

window.addEventListener('order-success', (event) => {

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

const sunIcon = document.getElementById('sun');
const moonIcon = document.getElementById('moon');
const switchBtn = document.getElementById('themeBtn');
const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

switchBtn.addEventListener('click', () => {
  sunIcon.classList.toggle('hidden');
  moonIcon.classList.toggle('hidden');
  console.log('button clicked');
});


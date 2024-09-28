document.addEventListener('DOMContentLoaded',function(){
    let modal = document.querySelector('.modal');
    let sidebar = document.querySelector('.sidebar');
    let cancel = document.getElementById('cancel');
    let hamburger = document.getElementById('hamburger');

    hamburger.addEventListener('click',()=>{
        modal.style.display = "block";
        hamburger.style.display = "none";
        setTimeout(()=>{
            sidebar.style.left = "0%";
        },10);
    });

    cancel.addEventListener('click',()=>{
        hamburger.style.display = "block";
        sidebar.style.left = "-100%";
        setTimeout(()=>{
            modal.style.display = "none";
        },100);
    });

    window.addEventListener('click',(e)=>{
        if(e.target === modal){
            cancel.click();
        }
    });
});
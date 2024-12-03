
// change bg color when clickd

const links = document.querySelectorAll('.links');
const drop_downs = document.querySelectorAll('.drop-down');

links.forEach(link => {
    link.addEventListener('click', () => {
        // remove active class when class link and active si existed
        const activeLink = document.querySelector('.links.active');
        if (activeLink) {
            activeLink.classList.remove('active');
        }
        
        // add active class when clicked
        link.classList.add('active');
    });
});


// drop down items

drop_downs.forEach(drop => {
    drop.addEventListener('click', () => {
        // for drop item
        const drop_items = drop.querySelector('.drop-down-items');
        if (drop_items.style.display === "block") {
            drop_items.style.display = "none"; // hide if active
        } else {
            drop_items.style.display = "block"; // show if hidden

        }
        

        const drop_arrows = drop.querySelector('.arrow-move');
        if(drop_arrows.style.transform === "rotate(0deg)"){
            drop_arrows.style.transform = "rotate(-90deg)";
        }else{
            drop_arrows.style.transform = "rotate(0deg)";
        }

    });


});

// prevent dropdown items when clicjing on dropdown items
const dropItemLinks = document.querySelectorAll('.drop-down-items .links');
dropItemLinks.forEach(dropItem => {
    dropItem.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent event from bubbling up to the parent drop-down
    });
});



// refresh iframe when clicked

function refreshIframe(iframeId) {
    const iframe = document.getElementById(iframeId);
    if (iframe) {
    
      iframe.src = iframe.src; // refresh iframe
    }
  }



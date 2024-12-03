
function refreshIframe(iframeId) {
    const iframe = document.getElementById(iframeId);
    if (iframe) {
    
      iframe.src = iframe.src; // refresh iframe
    }
  }
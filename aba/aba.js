// ប្រើ Ajax ដើម្បីធ្វើការពិនិត្យការទូទាត់
function checkPayment(transactionId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "https://api.aba.com.kh/check-payment?transaction_id=" + transactionId, true);
    xhr.setRequestHeader("Authorization", "Bearer your_api_key_here");

    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // បញ្ជូនអ្នកប្រើទៅទំព័រថ្មី
                window.location.href = "success-page.html";
            } else {
                // បង្ហាញសារព្រមាន
                alert("កំហុស! ការទូទាត់មិនបានជោគជ័យ។ សូមព្យាយាមម្ដងទៀត។");
            }
        } else {
            alert("មានបញ្ហាក្នុងការតភ្ជាប់ទៅ API។ សូមព្យាយាមម្ដងទៀត។");
        }
    };
    
    xhr.send();
}

// សម្រង់លទ្ធផល
var transactionId = document.getElementById("transaction_id_input").value;
checkPayment(transactionId);

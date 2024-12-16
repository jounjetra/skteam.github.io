<?php
// ការកំណត់ព័ត៌មាន API ABA
$apiUrl = "https://api.aba.com.kh/check-payment"; // ត្រូវផ្លាស់ប្តូរជាមួយ URL ត្រឹមត្រូវ
$apiKey = "your_api_key_here"; // ត្រូវផ្លាស់ប្តូរជាមួយ API Key របស់អ្នក

// សមត្ថភាពនៃការត្រួតពិនិត្យព័ត៌មានទូទាត់
function checkPayment($transactionId) {
    global $apiUrl, $apiKey;
    
    // ធ្វើការផ្ញើសំណើ API សម្រាប់ពិនិត្យការទូទាត់
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl . "?transaction_id=" . $transactionId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $apiKey
    ));
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    // បង្ហាញលទ្ធផលបញ្ជាក់ការទូទាត់
    $responseData = json_decode($response, true);
    
    if ($responseData['status'] === 'success') {
        // បញ្ចូលទៅផ្ទាំងថ្មីបើការទូទាត់បានជោគជ័យ
        header("Location: success-page.php");
        exit();
    } else {
        // បង្ហាញសារព្រមានបើការទូទាត់មិនបានជោគជ័យ
        echo "កំហុស! ការទូទាត់មិនបានជោគជ័យ។ សូមព្យាយាមម្ដងទៀត។";
    }
}

// ជំរាបអ្នកប្រើប្រាស់ដោយប្រើ Transaction ID
$transactionId = $_POST['transaction_id']; // ឬតាមដែលអ្នកបានប្រើក្នុងការទទួលពត៌មាន

checkPayment($transactionId);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Listing</title>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="css/chatbox.css">
    
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <div class="card p-4 shadow-sm">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Choose Category</label>
                    <select class="form-control" name="cmbcategory">
                        <option>--Select--</option>
                        <?php
                        $q = pg_query("select * from tblcategory");
                        while ($r = pg_fetch_array($q)) {
                            echo "<option value='{$r['cid']}'>{$r['cname']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <input type="submit" name="btnsearchbycat" value="Search" class="btn btn-primary w-100">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Search by Name</label>
                    <input type="text" placeholder="Search by Name..." name="txtsearch" class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <input type="submit" name="btnsearch" value="Search" class="btn btn-primary w-100">
                </div>
                   <div class="col-md-12 d-flex justify-content-center mt-2">
        <input type="submit" name="btnviewall" value="View All Products" class="btn btn-success">
    </div>
            </form>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row g-4">
            <?php
            if (isset($_POST['btnsearchbycat'])) {
                extract($_POST);
                $q = pg_query("select * from tblproduct where cid = '".$cmbcategory."'");
            } elseif (isset($_POST['btnsearch'])) {
                extract($_POST);
                $q = pg_query("select * from tblproduct where pname like '%".$txtsearch."%'");
            } else {
                $q = pg_query("select * from tblproduct");
            }
            while ($r = pg_fetch_array($q)) {
                $date1 = date('Y-m-d');
                $date2 = $r['pdate'];
                if ($date1 < $date2) {
            ?>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="admin/<?php echo $r['pimage']; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: 250px; display: block; margin: auto; background-color: #f8f9fa;">
                        <div class="card-body text-center">
                            <h5 class="card-title"> <?php echo $r['pname']; ?> </h5>
                            <p class="text-muted"><strike>₹<?php echo $r['pprice']; ?></strike></p>
                            <p class="fw-bold text-success">₹<?php echo $r['pdprice']; ?></p>
                            <a href="viewdetails.php?id=<?php echo $r['pid']; ?>" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
<?php include 'footer.php'; ?>

<div id="chatbot-icon">
    <i class="fas fa-clinic-medical"></i>
    <div class="notification-dot"></div>
</div>
<div id="chatbot-box">
    <div id="chatbot-header">
        <h5><i class="fas fa-heartbeat"></i> Pharma360 Health Assistant</h5>
    </div>
    <div id="chatbot-messages">
        
        <div class="chatbot-category">Common Health Issues</div>
        <div class="chatbot-question" onclick="showResponse('fever')">I have fever, what should I do?</div>
        <div class="chatbot-question" onclick="showResponse('headache')">I'm experiencing headache</div>
        <div class="chatbot-question" onclick="showResponse('cough')">I have cough and cold</div>
        <div class="chatbot-question" onclick="showResponse('stomach')">I have stomach pain</div>
        <div class="chatbot-question" onclick="showResponse('allergies')">I'm having allergies</div>
        
        
        <div class="chatbot-category">Medicine Information</div>
        <div class="chatbot-question" onclick="showResponse('pain_meds')">Best medicines for pain relief</div>
        <div class="chatbot-question" onclick="showResponse('cold_meds')">Recommended cold & flu medicines</div>
        <div class="chatbot-question" onclick="showResponse('allergy_meds')">Common allergy medications</div>
        <div class="chatbot-question" onclick="showResponse('vitamins')">Essential vitamins & supplements</div>
        
        
        <div class="chatbot-category">Health Tips & Wellness</div>
        <div class="chatbot-question" onclick="showResponse('immunity')">How to boost immunity?</div>
        <div class="chatbot-question" onclick="showResponse('sleep')">Tips for better sleep</div>
        <div class="chatbot-question" onclick="showResponse('stress')">Managing stress naturally</div>
        <div class="chatbot-question" onclick="showResponse('diet')">Healthy diet recommendations</div>
    </div>
</div>

    <script>
document.getElementById('chatbot-icon').addEventListener('click', function() {
    const chatbox = document.getElementById('chatbot-box');
    if (chatbox.style.display === 'none' || chatbox.style.display === '') {
        chatbox.style.display = 'block';
    } else {
        chatbox.style.display = 'none';
    }
});

function showResponse(type) {
    const messagesDiv = document.getElementById('chatbot-messages');
    
    
    const previousResponses = messagesDiv.getElementsByClassName('alert-info');
    while (previousResponses.length > 0) {
        previousResponses[0].remove();
    }
    
    let response = '';
    
    switch(type) {
        
        case 'fever':
            response = 'For fever: <ul>' +
                '<li>Rest and stay hydrated</li>' +
                '<li>Consider taking Paracetamol (like Crocin) for fever reduction</li>' +
                '<li>Use cold compresses</li>' +
                '<li>Consult doctor if fever persists over 3 days</li>' +
                '<li>Suggested products: Crocin 500mg, Dolo 650</li></ul>';
            break;
        case 'headache':
            response = 'For headache relief: <ul>' +
                '<li>Rest in a quiet, dark room</li>' +
                '<li>Try over-the-counter pain relievers</li>' +
                '<li>Stay hydrated and practice relaxation techniques</li>' +
                '<li>Suggested products: Saridon, Disprin, Combiflam</li></ul>';
            break;
        case 'cough':
            response = 'For cough and cold: <ul>' +
                '<li>Rest and drink warm fluids</li>' +
                '<li>Try over-the-counter cough suppressants</li>' +
                '<li>Use steam inhalation</li>' +
                '<li>Suggested products: Vicks Action 500, Benadryl, Strepsils</li></ul>';
            break;
        case 'stomach':
            response = 'For stomach pain: <ul>' +
                '<li>Avoid heavy foods temporarily</li>' +
                '<li>Stay hydrated with clear fluids</li>' +
                '<li>Try antacids for indigestion</li>' +
                '<li>Suggested products: Digene, ENO, Gelusil</li></ul>';
            break;
        case 'allergies':
            response = 'For allergies: <ul>' +
                '<li>Identify and avoid triggers</li>' +
                '<li>Take antihistamines as recommended</li>' +
                '<li>Keep your environment clean</li>' +
                '<li>Suggested products: Cetrizine, Allegra, Avil</li></ul>';
            break;

        
        case 'pain_meds':
            response = 'Common pain relief medicines: <ul>' +
                '<li>Paracetamol: For fever and mild pain</li>' +
                '<li>Ibuprofen: For inflammation and pain</li>' +
                '<li>Aspirin: For pain and fever</li>' +
                '<li>Note: Always read instructions and check for allergies</li></ul>';
            break;
        case 'cold_meds':
            response = 'Recommended cold & flu medicines: <ul>' +
                '<li>Antihistamines: For runny nose</li>' +
                '<li>Decongestants: For blocked nose</li>' +
                '<li>Cough suppressants: For dry cough</li>' +
                '<li>Popular brands: Vicks Action 500, D\'Cold</li></ul>';
            break;
        case 'allergy_meds':
            response = 'Common allergy medications: <ul>' +
                '<li>Cetrizine: Daily antihistamine</li>' +
                '<li>Allegra: Non-drowsy option</li>' +
                '<li>Nasal sprays: For allergic rhinitis</li>' +
                '<li>Note: Consult doctor for chronic allergies</li></ul>';
            break;
        case 'vitamins':
            response = 'Essential vitamins & supplements: <ul>' +
                '<li>Vitamin C: For immunity (Limcee, Celin)</li>' +
                '<li>Vitamin D3: For bone health (Calcirol)</li>' +
                '<li>Multivitamins: For overall health</li>' +
                '<li>Calcium: For bone strength (Shelcal)</li></ul>';
            break;

        
        case 'immunity':
            response = 'Tips to boost immunity: <ul>' +
                '<li>Eat fruits rich in Vitamin C</li>' +
                '<li>Exercise regularly</li>' +
                '<li>Get adequate sleep</li>' +
                '<li>Consider supplements: Vitamin C, D, and Zinc</li>' +
                '<li>Stay hydrated and manage stress</li></ul>';
            break;
        case 'sleep':
            response = 'Tips for better sleep: <ul>' +
                '<li>Maintain a regular sleep schedule</li>' +
                '<li>Avoid screens before bedtime</li>' +
                '<li>Create a relaxing bedtime routine</li>' +
                '<li>Consider natural aids like Chamomile tea</li>' +
                '<li>Consult doctor if insomnia persists</li></ul>';
            break;
        case 'stress':
            response = 'Managing stress naturally: <ul>' +
                '<li>Practice deep breathing exercises</li>' +
                '<li>Regular physical activity</li>' +
                '<li>Maintain a healthy diet</li>' +
                '<li>Try meditation or yoga</li>' +
                '<li>Consider stress-relief supplements</li></ul>';
            break;
        case 'diet':
            response = 'Healthy diet recommendations: <ul>' +
                '<li>Eat plenty of fruits and vegetables</li>' +
                '<li>Include protein in every meal</li>' +
                '<li>Stay hydrated with water</li>' +
                '<li>Limit processed foods</li>' +
                '<li>Consider supplements if needed</li></ul>';
            break;
    }
    
    
    const responseElement = document.createElement('div');
    responseElement.className = 'alert alert-info mt-2';
    responseElement.innerHTML = response;
    

    responseElement.style.opacity = '0';
    messagesDiv.appendChild(responseElement);
    
    
    setTimeout(() => {
        responseElement.style.transition = 'opacity 0.3s ease-in';
        responseElement.style.opacity = '1';
    }, 10);
}
</script>
</body>
</html>
</body>
</html>
</body>
</html>

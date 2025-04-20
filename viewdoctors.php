<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consult Our Doctors</title>
    <?php include 'head.php'; ?> 
</head>
<body>

<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Consult Our Doctors</h2>

    
    <div class="alert alert-info text-center">
        <h4>How to Contact Our Doctors?</h4>
        <p>
            🔹 <b>Step 1:</b> Find a doctor based on their specialization.<br>
            🔹 <b>Step 2:</b> Use the provided <b>phone number</b> or <b>email</b> to contact them.<br>
            🔹 <b>Step 3:</b> Visit their hospital for a consultation if needed.<br>
            💡 <b>Note:</b> This platform does not provide online booking. Please contact the doctor directly.
        </p>
    </div>

    <div class="row">

        <?php
        

        $q = pg_query($conn, "SELECT * FROM tbldoctor");
        while ($r = pg_fetch_array($q)) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded p-3">
                    <div class="card-body">
                        <h4 class="text-success fw-bold">👨‍⚕️ <?php echo $r['dname']; ?></h4>
                        <p><b>Specialization:</b> <?php echo $r['dspecialization']; ?></p>
                        <p><b>Contact:</b> <span class="text-primary">📞 <?php echo $r['dcontact']; ?></span></p>
                        <p><b>Email:</b> <a href="mailto:<?php echo $r['demail']; ?>" class="text-decoration-none">📧 <?php echo $r['demail']; ?></a></p>
                        <p><b>Hospital:</b> 🏥 <?php echo $r['dhospital']; ?></p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

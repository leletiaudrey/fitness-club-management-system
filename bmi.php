<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<div class="container-fluid position-relative bmi my-5">
    <div class="container">
        <div class="row px-3 align-items-center">
            <div class="col-md-6">
                <div class="pr-md-3 d-none d-md-block">
                    <h4 class="text-primary">Body Mass Index </h4>
                    <h4 class="display-4 text-white font-weight-bold mb-4">BMI</h4>
                    <p class="m-0 text-white">The body mass index (BMI) is a measure that uses your height and weight to work out if your weight is healthy</p>
                </div>
            </div>
            <div class="col-md-6 bg-secondary py-5">
                <div class="py-5 px-3">
                    <h1 class="mb-4 text-white">Calculate your BMI</h1>
                    <form id="bmi-form">
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" class="form-control form-control-lg bg-dark text-white" placeholder="Weight (KG)" id="weight-input">
                            </div>
                            <div class="col form-group">
                                <input type="text" class="form-control form-control-lg bg-dark text-white" placeholder="Height (CM)" id="height-input">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" class="form-control form-control-lg bg-dark text-white" placeholder="Age" id="age-input">
                            </div>
                            <div class="col form-group">
                                <select class="custom-select custom-select-lg bg-dark text-muted" id="gender-select">
                                    <option>Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="button" class="btn btn-lg btn-block btn-dark border-light" value="Calculate Now" onclick="calculateBMI()">
                            </div>
                        </div>
                    </form>
                    <div id="bmi-result" class="mt-4" style="display: none;">
                        <h4 class="text-white">Your BMI:</h4>
                        <p id="bmi-value" class="text-white"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calculateBMI() {
        var weight = parseFloat(document.getElementById("weight-input").value);
        var height = parseFloat(document.getElementById("height-input").value) / 100; // Convert cm to meters
        var age = parseInt(document.getElementById("age-input").value);
        var gender = document.getElementById("gender-select").value;

        // Perform the BMI calculation
        var bmi = weight / (height * height);

        // Adjust BMI calculation for age and gender if necessary
        if (age < 20) {
            if (gender === "Male") {
                bmi = 0.5 * weight / (Math.sqrt(height) * Math.sqrt(height)) + 11.5;
            } else if (gender === "Female") {
                bmi = 0.5 * weight / (Math.sqrt(height) * Math.sqrt(height)) + 11.5;
            }
        }

        // Display the calculated BMI
        document.getElementById("bmi-value").textContent = bmi.toFixed(2);
        document.getElementById("bmi-result").style.display = "block";
    }
</script>

</body>
</html>
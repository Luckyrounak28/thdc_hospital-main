document.addEventListener('DOMContentLoaded', function() {
    // Generate OPD Reg No and Date/Time
    const opdRegNo = 'OPD' + Date.now();
    const regDate = new Date().toLocaleString();
    document.getElementById('opd_reg_no').value = opdRegNo;
    document.getElementById('reg_date').value = regDate;

    // Toggle fields based on category
    function toggleFields() {
        const category = document.getElementById('category').value;
        const categoryAFields = document.getElementById('categoryAFields');
        const workplace = document.getElementById('workplace');
        if (category === 'B') {
            categoryAFields.style.display = 'none';
            workplace.style.display = 'block';
        } else {
            categoryAFields.style.display = 'block';
            workplace.style.display = 'none';
        }
    }
    toggleFields();
});
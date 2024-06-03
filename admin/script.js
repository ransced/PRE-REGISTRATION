document.addEventListener('DOMContentLoaded', () => {
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');

allDropdown.forEach(item=>{
    const a = item.parentElement.querySelector('a:first-child');
        a.addEventListener('click', function(e){
            e.preventDefault();

            if(!this.classList.contains('active')){
                allDropdown.forEach(i=>{
                    const aLink = i.parentElement.querySelector('a:first-child');

                    aLink.classList.remove('active');
                    i.classList.remove('show');
                })
            }

            this.classList.toggle('active');
            item.classList.toggle('show');
    
        })
})
})

const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');

imgProfile.addEventListener('click', function(){
    dropdownProfile.classList.toggle('show')
})

window.addEventListener('click', function (e){
    if(e.target !== imgProfile){
        if(e.target !== dropdownProfile){
            if(dropdownProfile.classList.contains('show')){
                dropdownProfile.classList.remove('show');
            }
        }
    }
})
document.addEventListener('DOMContentLoaded', () => {
    const sideMenuItems = document.querySelectorAll('.side-menu a');

    sideMenuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            /*remove */
            sideMenuItems.forEach(item => {
                item.classList.remove('active');
            });
            /*add active*/
            this.classList.add('active');
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const addStudentButton = document.querySelector('.btn.add');
    
    addStudentButton.addEventListener('click', () => {
        const addStudentModal = new bootstrap.Modal(document.getElementById('addStudentModal'));
        addStudentModal.show();
    });

    const addStudentForm = document.getElementById('addStudentForm');
    addStudentForm.addEventListener('submit', (event) => {
        event.preventDefault();
        // Handle form submission, e.g., send data to server or update the table.
        console.log('Student added!');
        const addStudentModal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
        addStudentModal.hide();
    });
});
/**add program*/

document.addEventListener('DOMContentLoaded', () => {
    const saveProgramBtn = document.getElementById('saveProgramBtn');
    const addProgramForm = document.getElementById('addProgramForm');

    saveProgramBtn.addEventListener('click', () => {
        const programName = document.getElementById('programName').value;
        const programCode = document.getElementById('programCode').value;
        const totalCourses = document.getElementById('totalCourses').value;
        const totalUnits = document.getElementById('totalUnits').value;

        if (confirm("Are you sure you want to add?")) {

            console.log("Program Added:");
            console.log("Program Name:", programName);
            console.log("Program Code:", programCode);
            console.log("Total Number of Courses:", totalCourses);
            console.log("Total Units:", totalUnits);
        } else {

            const addProgramModal = new bootstrap.Modal(document.getElementById('addProgramModal'));
            addProgramModal.hide();
        }
    });
});

/*add course */
document.addEventListener('DOMContentLoaded', () => {
    const saveCourseBtn = document.getElementById('saveCourseBtn');
    const addCourseForm = document.getElementById('addCourseForm');

    saveCourseBtn.addEventListener('click', () => {
        const courseTitle = document.getElementById('courseTitle').value;
        const courseCode = document.getElementById('courseCode').value;
        const totalUnits = document.getElementById('totalUnits').value;
        const totalEnrolled = document.getElementById('totalEnrolled').value;
        const description = document.getElementById('description').value;

        if (confirm("Are you sure you want to add this course?")) {
            console.log("Course Added:");
            console.log("Course Title:", courseTitle);
            console.log("Course Code:", courseCode);
            console.log("Total Units:", totalUnits);
            console.log("Total No. of Enrolled:", totalEnrolled);
            console.log("Description:", description);

            
            const addCourseModal = new bootstrap.Modal(document.getElementById('addCourseModal'));
            addCourseModal.hide();
        }
    });
});
let students =
    {
        "Student":
            [
                {
                    "Name" : "Elric Barkey",
                    "First":"Elric",
                    "Last":"Barkey",
                    "SID" : "840789333",
                    "Email" : "ebarkey2@mail.greenriver.edu"
                },

                {
                    "Name" : "Elric Shmo",
                    "First":"Elric",
                    "Last":"Shmo",
                    "SID" : "840666450",
                    "Email" : "ElricjoS@mail.greenriver.edu"
                },

                {
                    "Name" : "Jo Mo",
                    "First":"Jo",
                    "Last":"Mo",
                    "SID" : "840530835",
                    "Email" : "JOMO3@mail.greenriver.edu"
                }

            ]

    };

document.getElementById("button").onclick = search;

function search()
{
    let searchData = document.getElementById("search").value.toLowerCase();
    let flag = false;

    //clear previous searches if any
    document.getElementById("studentInfo").innerHTML = "";
    document.getElementById("errorStudent").innerHTML = "";

    for (let i = 0; i < students.Student.length; i++)
    {
        if(students.Student[i].Name.toLowerCase().includes(searchData))
        {
            document.getElementById("studentInfo").innerHTML +=
                "<p>Name : " + students.Student[i].Name + "<br>" +
                "SID : " + students.Student[i].SID + "<br>" +
                "Email : " + students.Student[i].Email + "</p>" ;

            flag = true;
            document.getElementById("errorStudent").innerHTML = "";
        }

        // if(searchData === students.Student[i].Name.toLowerCase() || searchData === students.Student[i].Email.toLowerCase() || searchData === students.Student[i].SID.toLowerCase())
        // {
        //     document.getElementById("studentInfo").innerHTML =
        //         "Name : " + students.Student[i].Name + "<br>" +
        //         "SID : " + students.Student[i].SID + "<br>" +
        //         "Email : " + students.Student[i].Email + "<br>" ;
        //
        //     flag = true;
        //     document.getElementById("errorStudent").innerHTML = "";
        // }

        // if (searchData === students.Student[i].First.toLowerCase())
        // {
        //     document.getElementById("studentInfo").innerHTML +=
        //         "<br>" +
        //         "Name : " + students.Student[i].First + " " + students.Student[i].Last + "<br>" +
        //         "SID : " + students.Student[i].SID + "<br>" +
        //         "Email : " + students.Student[i].Email + "<br>" ;
        //     flag = true;
        //     document.getElementById("errorStudent").innerHTML = "";
        // }

        if (flag === false)
        {
            document.getElementById("errorStudent").innerHTML = "No results found.";
        }
    }
}

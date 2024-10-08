document.getElementById("sectionForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const sectionCount = document.getElementById("sectionCount").value;
  generateSectionFields(sectionCount);
});

function generateSectionFields(count) {
  let formHtml =
    '<form id="contentForm" class="w-75 mx-auto" style="min-width:350px; max-width: 1000px;">';

  for (let i = 1; i <= count; i++) {
    formHtml += `
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Section ${i}</h5>
          <div class="form-group my-3">
            <label class="my-2" for="heading${i}">Heading:</label>
            <input type="text" class="form-control" id="heading${i}" name="genericSections[${
      i - 1
    }][heading]" required>
          </div>
          <div class="form-group my-3">
            <label class="my-2" for="description${i}">Description:</label>
            <textarea class="form-control" id="description${i}" name="genericSections[${
      i - 1
    }][description]" required></textarea>
          </div>
          <div class="form-group my-3">
            <label class="my-2" for="alignment${i}">Alignment:</label>
            <select class="form-control" id="alignment${i}" name="genericSections[${
      i - 1
    }][alignment]">
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select>
          </div>
          <h6>Subheading 1</h6>
          <div class="form-group my-3">
            <label class="my-2" for="subheading1${i}">Subheading:</label>
            <input type="text" class="form-control" id="subheading1${i}" name="genericSections[${
      i - 1
    }][subheads][0][heading]" required>
          </div>
          <div class="form-group my-3">
            <label class="my-2" for="subdescription1${i}">Subheading Description:</label>
            <textarea class="form-control" id="subdescription1${i}" name="genericSections[${
      i - 1
    }][subheads][0][description]" required></textarea>
          </div>
          <h6>Subheading 2</h6>
          <div class="form-group my-3">
            <label class="my-2" for="subheading2${i}">Subheading:</label>
            <input type="text" class="form-control" id="subheading2${i}" name="genericSections[${
      i - 1
    }][subheads][1][heading]" required>
          </div>
          <div class="form-group my-3">
            <label class="my-2" for="subdescription2${i}">Subheading Description:</label>
            <textarea class="form-control" id="subdescription2${i}" name="genericSections[${
      i - 1
    }][subheads][1][description]" required></textarea>
          </div>
        </div>
      </div>
    `;
  }

  formHtml +=
    '<input type="hidden" id="genericSections" name="genericSections"/>' +
    '<button type="submit" class="btn btn-success">Submit Content</button></form>';
  document.getElementById("dynamicForm").innerHTML = formHtml;

  document
    .getElementById("contentForm")
    .addEventListener("submit", submitContent);
}
function removeSectionFields() {
  document.getElementById("dynamicForm").innerHTML = "";
}
function submitContent(e) {
  e.preventDefault();

  const formData = new FormData(e.target);
  const data = Object.fromEntries(formData);

  const genericSections = {}; // Change from array to object
  let i = 0;
  while (data[`genericSections[${i}][heading]`] !== undefined) {
    genericSections[`section_${i + 1}`] = {
      // Create unique keys for each section
      heading: data[`genericSections[${i}][heading]`] || "",
      description: data[`genericSections[${i}][description]`] || "",
      alignment: data[`genericSections[${i}][alignment]`] || "left",
      subheads: [
        {
          heading: data[`genericSections[${i}][subheads][0][heading]`] || "",
          description:
            data[`genericSections[${i}][subheads][0][description]`] || "",
        },
        {
          heading: data[`genericSections[${i}][subheads][1][heading]`] || "",
          description:
            data[`genericSections[${i}][subheads][1][description]`] || "",
        },
      ],
    };
    i++;
  }
  console.log(JSON.stringify(genericSections, null, 2)); // Pretty print JSON for debugging

  fetch("submitform.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(genericSections), // Now sending as an object, not an array
  })
    .then((response) => response.text())
    .then((text) => {
      console.log("Raw response:", text);
      const data = JSON.parse(text);
      console.log("Parsed JSON:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });

  removeSectionFields();
  location.reload();
}

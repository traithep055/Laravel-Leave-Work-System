(function (jsPDFAPI) {
    var font_base64_data = "..."; // long base64 encoded string
    // Other related font data and mappings...
    jsPDFAPI.addFileToVFS("fontName.ttf", font_base64_data);
    jsPDFAPI.addFont("fontName.ttf", "fontName", "normal");
})(jsPDF.API);

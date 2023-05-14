const file = document.querySelector('#file').value;;

let pdfDoc = null,
	pageNum = 1,
	pageIsRendering = false,
	pageNumIsPending = null;

const scale = 2,
	canvas = document.querySelector('#pdf-render'),
	ctx = canvas.getContext('2d');

// Render The Page
const renderPage = num => {
	pageIsRendering = true;

	pdfDoc.getPage(num).then(page => {

		// Set Scale
		const viewport = page.getViewport({ scale });
		canvas.height = viewport.height;
		canvas.width = viewport.width;

		const renderCtx = {
			canvasContext: ctx,
			viewport
		}

		page.render(renderCtx).promise.then(() => {
			pageIsRendering = false;

			if(pageNumIsPending !== null) {
				renderPage(pageNumIsPending);
				pageNumIsPending = null;
			}
		})
	});

	// Ouput current page
	document.querySelector('#page-num').textContent = num;
};

// Check for pages rendering
const queueRenderPage = num => {
	if(pageIsRendering) {
		pageNumIsRendering = num;
	} else {
		renderPage(num);
	}
}

// Show Prev Page
const showPrevPage = () => {
	if(pageNum <= 1) {
		return;
	}
	pageNum--;
	queueRenderPage(pageNum);
}

// Show Next Page
const showNextPage = () => {
	if(pageNum >= pdfDoc.numPages) {
		return;
	}
	pageNum++;
	queueRenderPage(pageNum);
}

// Get Document
pdfjsLib.getDocument(file).promise.then(pdfDoc_ => {
	pdfDoc = pdfDoc_;

	document.querySelector('#page-count').textContent = pdfDoc.numPages;

	renderPage(pageNum);

});

// Button Events
document.querySelector('#prev-page').addEventListener('click', showPrevPage);
document.querySelector('#next-page').addEventListener('click', showNextPage);
<template>
    <div>
        <div>
            <div class="div">
                <div class="mt-6" id="forgeViewer"></div>
            </div>
        </div>
        <div>
            <div class="mt-6" id="propertiesInspect">
                <code>
                    {{JSON.stringify(inspectedObject)}}
                </code>
            </div>
        </div>
    </div>
</template>

<script>
// A little hacky needs to be changed
var viewer;
export default {
    data() {
        return {
            inspectedObject: {},
            documentId: 'urn:dXJuOmFkc2sub2JqZWN0czpvcy5vYmplY3Q6dGVzdF9maWxlLmR3Zy90ZXN0X2ZpbGUuZHdn',
            options: {
                env: 'AutodeskProduction',
                api: 'derivativeV2',  // for models uploaded to EMEA change this option to 'derivativeV2_EU'
                extension: ['ModelStructure'],
                getAccessToken: function(onTokenReady) {
                    var token = 'eyJhbGciOiJSUzI1NiIsImtpZCI6IlU3c0dGRldUTzlBekNhSzBqZURRM2dQZXBURVdWN2VhIn0.eyJzY29wZSI6WyJidWNrZXQ6Y3JlYXRlIiwiZGF0YTp3cml0ZSIsImRhdGE6cmVhZCJdLCJjbGllbnRfaWQiOiJXc08xeXVLTnNHWDhQSjZTcUV0UGZJRzhTNDl6bWdCTiIsImF1ZCI6Imh0dHBzOi8vYXV0b2Rlc2suY29tL2F1ZC9hand0ZXhwNjAiLCJqdGkiOiJVakZuWmt2WWVncHZVaDFwdHRobzZhdk96T0pMb2w5cmtSQ0JqNFpxZGE0aGExT3lZODRzWFk0a1UzRDBZYmV3IiwiZXhwIjoxNjIzNjg3MzI1fQ.G4aV6FGVnBK9klGI2yvgPJ5dkzuEesI0hiJyFA8qJCc6FkmCie-iCpGwYUBn_X1BwOWVoRjYN4XFwf-faqE6oGtqACExJU4OSfhXD5oHfhRht1yFVtZ-_ajKIZFqFRpE9ReLRt2S-b7vzJLWqTC1uDSCKn_Rcxp25qicUAP5RpxXqqYb0azgWqj7kOM1QP1V3ti9T78vDdKaTY46eyLkY20lUklEKpfQzcBMRJBMGX_7iVTSHlN-0gfRUcSk8ejI7sbfCQn8K6fsURj3qCc7vyNbkzXGMecZsVQSqtuaZthyFmWyqaQ0co7KP6Uk4aalNNTl279PHy5URQRNGDRV9A';
                    var timeInSeconds = 3600; // Use value provided by Forge Authentication (OAuth) API
                    onTokenReady(token, timeInSeconds);
                }
            },
        }
    },
    methods: {
        onSelectionChange(event) {
            const self = this;
            if (event.dbIdArray.length === 1) {
                viewer.getProperties(event.dbIdArray[0], function(data) {
                    self.$emit('selectionChanged', {...data})
                })
            }
        },
        onDocumentLoadSuccess(viewerDocument) {
            var defaultModel = viewerDocument.getRoot().getDefaultGeometry();
            viewer.loadDocumentNode(viewerDocument, defaultModel);
            viewer.addEventListener(Autodesk.Viewing.SELECTION_CHANGED_EVENT, this.onSelectionChange)
        },
        onDocumentLoadFailure () {
            console.error('Failed fetching Forge manifest');
        }

    },
	mounted(){
        Autodesk.Viewing.Initializer(this.options, function() {
            var htmlDiv = document.getElementById('forgeViewer');
            viewer = new Autodesk.Viewing.GuiViewer3D(htmlDiv);
            viewer.loadExtension('Autodesk.ModelStructure');
            var startedCode = viewer.start();
            if (startedCode > 0) {
                console.error('Failed to create a Viewer: WebGL not supported.');
                return;
            }
            console.log('Initialization complete, loading a model next...');
        })
        Autodesk.Viewing.Document.load(this.documentId, this.onDocumentLoadSuccess, this.onDocumentLoadFailure);
    }
}
</script>

<style>
    #forgeViewer {
        height: 50vh;
    }
</style>

from flask import Flask, request, jsonify
from PIL import Image
import pytesseract
import io

app = Flask(__name__)

@app.route('/ocr', methods=['POST'])
def ocr_image():
    if 'image' not in request.files:
        return jsonify({'error': 'No image uploaded'}), 400
    
    image_file = request.files['image']
    image = Image.open(image_file.stream)
    
    # Extrae texto con Tesseract
    text = pytesseract.image_to_string(image, lang='eng')  # puedes cambiar a 'spa' si es en español

    return jsonify({'text': text})

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)

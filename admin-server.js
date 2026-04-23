const express = require('express');
const fs = require('fs');
const path = require('path');
const { JSDOM } = require('jsdom');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors());
app.use(express.json());
app.use(express.static(__dirname));

// Helper to get all workshop files
const getWorkshopFiles = () => {
    return fs.readdirSync(__dirname)
        .filter(file => file.startsWith('workshop-') && file.endsWith('.html'));
};

// Helper to get all lecturer files (excluding other known files)
const getLecturerFiles = () => {
    const excluded = ['index.html', 'admin.html'];
    return fs.readdirSync(__dirname)
        .filter(file => 
            file.endsWith('.html') && 
            !file.startsWith('workshop-') && 
            !excluded.includes(file)
        );
};

// API: Get all workshops
app.get('/api/workshops', (req, res) => {
    try {
        const files = getWorkshopFiles();
        const workshops = files.map(file => {
            const html = fs.readFileSync(path.join(__dirname, file), 'utf8');
            const dom = new JSDOM(html);
            const doc = dom.window.document;
            
            return {
                id: file,
                title: doc.querySelector('.workshop-title')?.textContent.trim() || '',
                description: doc.querySelector('.workshop-description')?.textContent.trim() || '',
                lecturer: doc.querySelector('.workshop-lecturer a')?.textContent.trim() || '',
                eyebrow: doc.querySelector('.workshop-eyebrow')?.textContent.trim() || '',
                tag: doc.querySelector('.workshop-tag')?.textContent.trim() || ''
            };
        });
        res.json(workshops);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});

// API: Get all lecturers
app.get('/api/lecturers', (req, res) => {
    try {
        const files = getLecturerFiles();
        const lecturers = files.map(file => {
            const html = fs.readFileSync(path.join(__dirname, file), 'utf8');
            const dom = new JSDOM(html);
            const doc = dom.window.document;
            
            // Only include if it looks like a profile page
            const title = doc.querySelector('.profile-title')?.textContent.trim();
            if (!title) return null;

            return {
                id: file,
                name: title,
                role: doc.querySelector('.profile-role')?.textContent.trim() || '',
                bio: doc.querySelector('.profile-bio')?.textContent.trim() || '',
                image: doc.querySelector('.profile-image-wrap img')?.getAttribute('src') || ''
            };
        }).filter(l => l !== null);
        res.json(lecturers);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});

// API: Save changes to a file
app.post('/api/save', (req, res) => {
    try {
        const { id, type, data } = req.body;
        const filePath = path.join(__dirname, id);
        
        if (!fs.existsSync(filePath)) {
            return res.status(404).json({ error: 'File not found' });
        }

        let html = fs.readFileSync(filePath, 'utf8');
        const dom = new JSDOM(html);
        const doc = dom.window.document;

        if (type === 'workshop') {
            if (data.title) doc.querySelector('.workshop-title').textContent = data.title;
            if (data.description) doc.querySelector('.workshop-description').textContent = data.description;
            if (data.eyebrow) doc.querySelector('.workshop-eyebrow').textContent = data.eyebrow;
            if (data.tag) doc.querySelector('.workshop-tag').textContent = data.tag;
        } else if (type === 'lecturer') {
            if (data.name) doc.querySelector('.profile-title').textContent = data.name;
            if (data.role) doc.querySelector('.profile-role').textContent = data.role;
            if (data.bio) doc.querySelector('.profile-bio').textContent = data.bio;
        }

        fs.writeFileSync(filePath, dom.serialize(), 'utf8');
        res.json({ success: true });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
});

app.listen(port, () => {
    console.log(`Admin server running at http://localhost:${port}`);
});

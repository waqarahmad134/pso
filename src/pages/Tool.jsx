import React, { useState, useRef, useEffect } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { success_toaster, error_toaster } from '../utilities/Toaster';

export default function Tool() {
  const [inputText, setInputText] = useState('');
  const [outputText, setOutputText] = useState('');
  const [isSpeaking, setIsSpeaking] = useState(false);
  const [voices, setVoices] = useState([]);
  const [selectedVoice, setSelectedVoice] = useState(null);
  const [selectionCount, setSelectionCount] = useState(0);
  const speechRef = useRef(null);
  const outputRef = useRef(null);
  const utteranceRef = useRef(null);

  // Load available voices when component mounts
  useEffect(() => {
    // Function to load voices with retry mechanism
    const loadVoices = () => {
      try {
        // Force the browser to load voices
        window.speechSynthesis.getVoices();
        
        // Use a timeout to ensure voices are loaded
        setTimeout(() => {
          const availableVoices = window.speechSynthesis.getVoices();
          console.log('Available voices:', availableVoices);
          
          if (availableVoices.length > 0) {
            setVoices(availableVoices);
            
            // Try to find a Hindi voice, otherwise use the first available voice
            const hindiVoice = availableVoices.find(voice => 
              voice.lang.includes('hi') || voice.lang.includes('hi-IN')
            );
            
            setSelectedVoice(hindiVoice || availableVoices[0]);
          } else {
            console.warn('No voices available after timeout');
            // Try one more time with a longer timeout
            setTimeout(() => {
              const voices = window.speechSynthesis.getVoices();
              if (voices.length > 0) {
                setVoices(voices);
                setSelectedVoice(voices[0]);
              } else {
                error_toaster('No speech voices available. Please try a different browser.');
              }
            }, 1000);
          }
        }, 100);
      } catch (error) {
        console.error('Error loading voices:', error);
        error_toaster('Error loading speech voices. Please try a different browser.');
      }
    };
    
    // Load voices immediately if available
    loadVoices();
    
    // Also listen for voices to be loaded
    if (window.speechSynthesis) {
      window.speechSynthesis.onvoiceschanged = loadVoices;
    }
    
    return () => {
      if (window.speechSynthesis) {
        window.speechSynthesis.onvoiceschanged = null;
      }
    };
  }, []);

  // Initialize speech synthesis on component mount
  useEffect(() => {
    // This is a workaround for browsers that need a "warm-up" call to speechSynthesis
    if (window.speechSynthesis) {
      // Make a silent call to initialize speech synthesis
      const silentUtterance = new SpeechSynthesisUtterance('');
      silentUtterance.volume = 0;
      window.speechSynthesis.speak(silentUtterance);
      window.speechSynthesis.cancel();
    }
  }, []);

  // Check for speech synthesis permissions
  useEffect(() => {
    const checkSpeechPermissions = async () => {
      try {
        // Check if the browser supports the Permissions API
        if (navigator.permissions && navigator.permissions.query) {
          // Request permission for speech synthesis
          const permissionStatus = await navigator.permissions.query({ name: 'microphone' });
          
          if (permissionStatus.state === 'denied') {
            error_toaster('Speech synthesis permission denied. Please enable it in your browser settings.');
          } else if (permissionStatus.state === 'prompt') {
            success_toaster('Speech synthesis may require permission. Please allow when prompted.');
          }
          
          // Listen for permission changes
          permissionStatus.onchange = () => {
            if (permissionStatus.state === 'granted') {
              success_toaster('Speech synthesis permission granted.');
            } else if (permissionStatus.state === 'denied') {
              error_toaster('Speech synthesis permission denied.');
            }
          };
        }
      } catch (error) {
        console.error('Error checking speech permissions:', error);
      }
    };
    
    checkSpeechPermissions();
  }, []);

  // Add event listener for copy events
  useEffect(() => {
    const handleCopyEvent = (e) => {
      // Only handle copy events from the output textarea
      if (e.target === outputRef.current) {
        // Get the selected text
        const selection = window.getSelection();
        const selectedText = selection.toString().trim();
        
        if (selectedText) {
          // Remove numbering from the selected text
          const textWithoutNumbers = selectedText.replace(/^\d+\.\s/gm, '');
          
          // Set the clipboard data
          e.clipboardData.setData('text/plain', textWithoutNumbers);
          
          // Prevent the default copy behavior
          e.preventDefault();
          
          // Show success toast
          success_toaster('Copied successfully.');
        }
      }
    };
    
    // Add event listener for copy events
    document.addEventListener('copy', handleCopyEvent);
    
    // Clean up event listener on component unmount
    return () => {
      document.removeEventListener('copy', handleCopyEvent);
    };
  }, []);

  const handleProcess = () => {
    // Show success toast when processing starts
    success_toaster('Started processing...');

    // Remove timestamps (e.g., [00:00:00 - 00:00:03])
    const cleanedText = inputText
      .replace(/\[.*?\]/g, '') // removes [00:00:00 - 00:00:03]
      .replace(/\(\d{1,2}:\d{2}(?::\d{2})?\)/g, '') // removes (00:00) or (00:00:00)
      .replace(/\d{1,2}:\d{2}(?::\d{2})?/g, '') // removes 00:00 or 00:00:00 without brackets
      .trim();
    
    // Function to split the text into paragraphs with around 680 characters each
    const createParagraphs = (text, charsPerParagraph = 680) => {
      const paragraphs = [];
      for (let i = 0; i < text.length; i += charsPerParagraph) {
        const paragraphNumber = Math.floor(i / charsPerParagraph) + 1;
        paragraphs.push(`${paragraphNumber}. ${text.slice(i, i + charsPerParagraph)}`);
      }
      return paragraphs.join('\n\n'); // Separate paragraphs with two newlines
    };

    // Create the paragraphs and set them to output
    const formattedText = createParagraphs(cleanedText);
    setOutputText(formattedText);

    // Show success toast after processing
    success_toaster('Text processed successfully.');
  };

  const handleCopy = () => {
    // Remove numbering from the text before copying
    const textWithoutNumbers = outputText.replace(/^\d+\.\s/gm, '');
    navigator.clipboard.writeText(textWithoutNumbers);

    // Show success toast when copying to clipboard is successful
    success_toaster('Copied successfully.');
  };

  const handleTextSelection = () => {
    const selection = window.getSelection();
    const selectedText = selection.toString().trim();
    
    if (selectedText) {
      console.log(`Selected text: "${selectedText}"`);
      console.log(`Character count: ${selectedText.length}`);
      setSelectionCount(selectedText.length);
    } else {
      setSelectionCount(0);
    }
  };

  // Completely new approach for speech synthesis
  const handleSpeak = () => {
    // If already speaking, stop it
    if (isSpeaking) {
      window.speechSynthesis.cancel();
      setIsSpeaking(false);
      return;
    }
    
    // Check if there's text to speak
    if (!outputText.trim()) {
      error_toaster('No text to speak');
      return;
    }
    
    // Check if speech synthesis is supported
    if (!window.speechSynthesis) {
      error_toaster('Speech synthesis not supported in this browser');
      return;
    }
    
    try {
      // Cancel any ongoing speech
      window.speechSynthesis.cancel();
      
      // Create a new utterance
      const utterance = new SpeechSynthesisUtterance(outputText);
      
      // Set basic properties
      utterance.rate = 1.0;
      utterance.pitch = 1.0;
      utterance.volume = 1.0;
      
      // Set language based on content
      const hasHindi = /[\u0900-\u097F]/.test(outputText);
      utterance.lang = hasHindi ? 'hi-IN' : 'en-US';
      
      // Set voice if available
      if (selectedVoice) {
        utterance.voice = selectedVoice;
      }
      
      // Set up event handlers
      utterance.onstart = () => {
        setIsSpeaking(true);
        success_toaster('Speaking...');
      };
      
      utterance.onend = () => {
        setIsSpeaking(false);
      };
      
      utterance.onerror = (event) => {
        console.error('Speech error:', event);
        setIsSpeaking(false);
        error_toaster('Speech error occurred. Please try again.');
      };
      
      // Speak the text
      window.speechSynthesis.speak(utterance);
      
    } catch (error) {
      console.error('Error in speech synthesis:', error);
      setIsSpeaking(false);
      error_toaster('Error in speech synthesis. Please try again.');
    }
  };

  const handleVoiceChange = (e) => {
    const voiceIndex = e.target.value;
    setSelectedVoice(voices[voiceIndex]);
  };

  return (
    <div>
      <DefaultLayout>
        <Breadcrumb pageName="Youtube Script" />
        <div className="grid grid-cols-2 gap-2">
          <div className="overflow-x-auto">
            <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Add Entries
            </label>
            <textarea
              rows="16"
              className="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="..."
              value={inputText}
              onChange={(e) => setInputText(e.target.value)}
            ></textarea>
            <button
              className="rounded bg-black text-white font-medium border py-2 px-4 my-3"
              onClick={handleProcess}
            >
              Submit
            </button>
          </div>
          <div className="overflow-x-auto">
            <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Output
            </label>
            <div className="relative">
              <textarea
                ref={outputRef}
                rows="16"
                className="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="..."
                value={outputText}
                onChange={(e) => setOutputText(e.target.value)}
                onMouseUp={handleTextSelection}
                onKeyUp={handleTextSelection}
              ></textarea>
              
              {selectionCount > 0 && (
                <div className="absolute top-0 right-0 bg-white text-black text-xs rounded-bl px-2 py-1 shadow-lg font-medium border border-gray-300">
                  {selectionCount} characters selected
                </div>
              )}
            </div>
            <div className="flex flex-col space-y-2 mt-2">
              <div className="flex justify-between items-center">
                <span className="text-sm text-gray-700 dark:text-gray-300">
                  Characters: {outputText.length}
                </span>
                <div className="flex space-x-2">
                  <button
                    className="rounded bg-blue-500 text-white font-medium border py-2 px-4"
                    onClick={handleCopy}
                  >
                    Copy
                  </button>
                  <button
                    className={`rounded ${isSpeaking ? 'bg-red-500' : 'bg-green-500'} text-white font-medium border py-2 px-4`}
                    onClick={handleSpeak}
                  >
                    {isSpeaking ? 'Stop' : 'Speak'}
                  </button>
                </div>
              </div>
              
              {voices.length > 0 && (
                <div className="flex items-center space-x-2">
                  <label className="text-sm text-gray-700 dark:text-gray-300">Voice:</label>
                  <select 
                    className="text-sm border rounded p-1"
                    value={voices.indexOf(selectedVoice)}
                    onChange={handleVoiceChange}
                  >
                    {voices.map((voice, index) => (
                      <option key={index} value={index}>
                        {voice.name} ({voice.lang})
                      </option>
                    ))}
                  </select>
                </div>
              )}
            </div>
          </div>
        </div>
      </DefaultLayout>
    </div>
  );
}


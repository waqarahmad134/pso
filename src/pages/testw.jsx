const startRecording = async () => {
    try {
      const stream = await navigator.mediaDevices.getDisplayMedia({
        video: true,
        audio: {
          autoGainControl: false,
          echoCancellation: false,
          noiseSuppression: false,
          sampleRate: 44100,
          suppressLocalAudioPlayback: false,
          channelCount: 2
        }
      });
  
      mediaRecorderRef.current = new MediaRecorder(stream, { mimeType: "video/webm" });
  
      mediaRecorderRef.current.ondataavailable = (event) => {
        if (event.data.size > 0) {
          chunksRef.current.push(event.data);
        }
      };
  
      mediaRecorderRef.current.onstop = () => {
        const blob = new Blob(chunksRef.current, { type: "video/webm" });
        const url = URL.createObjectURL(blob);
        setVideoURL(url);
        chunksRef.current = [];
      };
  
      mediaRecorderRef.current.start();
      setRecording(true);
    } catch (error) {
      console.error("Error starting screen recording:", error);
    }
  };
  
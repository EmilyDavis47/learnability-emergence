
#input is a binary array, which can be nested
  #flipHoriz and flipVert = prepositonal interpretations are opposite of default; right and under instead of left and atop
def arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names, preps, prepSwap): #x prep y
  if prepSwap ==  True:
      preps = preps[::-1]
  caption = ''
  if type(x) == int: 
    caption = str(names[x])
  elif type(x) == list and len(x) == 1:
    caption = arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
  elif type(x) == list and len(x) == 2:
    if type(x[1]) == int or (type(x[1]) == list and len(x[1]) > 1): #[0, [1,2]] or [0,1]
      if flipHoriz == True:
        caption =  arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names, preps, prepSwap)  + preps[0]  + arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
      else: 
        caption =  arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names, preps, prepSwap)  + preps[0]  + arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names, preps, prepSwap)
    else: #[0, [1]]
      if flipVert == True:
        caption =  arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names, preps, prepSwap)  + preps[1]  + arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
      else: 
        caption =  arrayToCaptionPostNomPrePos(x[0], flipHoriz, flipVert, names, preps, prepSwap)  + preps[1]  + arrayToCaptionPostNomPrePos(x[1], flipHoriz, flipVert, names, preps, prepSwap)
  return caption

def arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names, preps, prepSwap): #backwards of English order
  if prepSwap ==  True:
      preps = preps[::-1]
  caption = ''
  if type(x) == int: 
    caption = str(names[x])
  elif type(x) == list and len(x) == 1:
    caption = arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
  elif type(x) == list and len(x) == 2:
    if type(x[1]) == int or (type(x[1]) == list and len(x[1]) > 1): #[0, [1,2]] or [0,1]
      if flipHoriz == True:
        caption =  arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names, preps, prepSwap)  + preps[0]  + arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names, preps, prepSwap)
      else: 
        caption =  arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names, preps, prepSwap)  + preps[0]  + arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
    else: #[0, [1]]
      if flipVert == True:
        caption =  arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names, preps, prepSwap)  + preps[1]  + arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names, preps, prepSwap)
      else: 
        caption =  arrayToCaptionPreNomPostPos(x[1], flipHoriz, flipVert, names, preps, prepSwap)  + preps[1]  + arrayToCaptionPreNomPostPos(x[0], flipHoriz, flipVert, names, preps, prepSwap)
  return caption

import re

def arrayToCaptionCEPre(x, flipHoriz, flipVert, names, preps, prepSwap): #center-embedding, head final
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names, preps, prepSwap)
  preps =r'['+preps[0]+preps[1]+']'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew[::-1]
  return caption


def arrayToCaptionCEPost(x, flipHoriz, flipVert, names, preps, prepSwap): #center-embedding, head initial
  caption = arrayToCaptionCEPre(x, flipHoriz, flipVert, names, preps, prepSwap)[::-1]
  return caption

def arrayToCaptionCrossedPreHeadFirst(x, flipHoriz, flipVert, names, preps, prepSwap): #crossed dependency, head initial and prepositions
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names, preps, prepSwap)
  preps =r'['+preps[0]+preps[1]+']'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew
  return caption

def arrayToCaptionCrossedPostHeadFirst(x, flipHoriz, flipVert, names, preps, prepSwap): #crossed dependency, head final and postpositions
  captionInit = arrayToCaptionPostNomPrePos(x, flipHoriz, flipVert, names, preps, prepSwap)
  preps =r'['+preps[0]+preps[1]+']'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption =  nounsNew + prepsNew
  return caption

def arrayToCaptionCrossedPreHeadLast(x, flipHoriz, flipVert, names, preps, prepSwap): #crossed dependency, head final and prepositions
  captionInit = arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names, preps, prepSwap)
  preps =r'['+preps[0]+preps[1]+']'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = prepsNew + nounsNew
  return caption

def arrayToCaptionCrossedPostHeadLast(x, flipHoriz, flipVert, names, preps, prepSwap): #crossed dependency, head final and postpositions
  captionInit = arrayToCaptionPreNomPostPos(x, flipHoriz, flipVert, names, preps, prepSwap)
  preps =r'['+preps[0]+preps[1]+']'
  nouns = r'['+"".join(names)+']'
  prepsNew = ''.join(re.findall(preps, captionInit))
  nounsNew = ''.join(re.findall(nouns, captionInit))
  caption = nounsNew + prepsNew 
  return caption

allgrammars = [arrayToCaptionPostNomPrePos, arrayToCaptionPreNomPostPos, arrayToCaptionCEPost, arrayToCaptionCEPre, arrayToCaptionCrossedPreHeadFirst, arrayToCaptionCrossedPostHeadFirst, arrayToCaptionCrossedPreHeadLast, arrayToCaptionCrossedPostHeadLast]
#, arrayToCaptionCEPost, arrayToCaptionCEPre, arrayToCaptionCrossedPreHeadFirst, arrayToCaptionCrossedPostHeadFirst, arrayToCaptionCrossedPreHeadLast, arrayToCaptionCrossedPostHeadLast]
gnames = ['HInitial-noCE', 'HFinal-noCE','HInitial-CE', 'HFinal-CE','HInitial-Crossed-PreP', 'HInitial-Crossed-PostP','HFinal-Crossed-PreP', 'HFinal-Crossed-PostP']

flipH = [False, True]
flipV = [False, True]
h = ["Left", "Right"]
v = ["Atop", "Under"]
prepSwap = [False, True] 


import pandas as pd
import ast
import csv
import numpy as np
import os, fnmatch

df = pd.read_csv('/Users/emilydavis/Desktop/paper data/pilotExperIter/allDataWritePilotIter1.csv')
def makeGrammar(df): 
  df= df.sort_values(by=['workerId'])
  users = sorted(list(set(list(df['workerId']))))

  newcolNames = [];
  newcols = []
  for g in range(len(allgrammars)): #all grammars
    for b1 in range(len(flipH)): #flipping meaning
       for b2 in range(len(flipV)): #flipping meaning of vertical adposition
           for b3 in range(len(prepSwap)): #swapping assignment of preps to spatial meanings
              newColGrammar = []
              for i in range(len(users)): #each user's noun and preposition sets
                  consonants = list(df[df.workerId == users[i]]['nounsUser'])[0]
                  consonantsPrep= list(df[df.workerId == users[i]]['prepsUser'])[0]
                  newColGrammarUser = []
                  arrays = list(df[df.workerId == users[i]]['arrayTraining'])
                  for a in range(len(arrays)):
                      newColGrammarUser.append(allgrammars[g](ast.literal_eval(arrays[a]), flipH[b1], flipV[b2], consonants, consonantsPrep, prepSwap[b3]))
                          #given array, in every possible grammar for user's lexicon
                  newColGrammar += newColGrammarUser #string together grammars for all the users
              if prepSwap[b3] == True:
                  c = [v,h]
              else:
                  c = [h,v]
              columnName = 'Grammar_'+gnames[g]+".m."+c[0][b1]+".r."+c[1][b2]
              newcolNames.append(columnName)
              newcols.append(newColGrammar)
  for k in range(len(newcolNames)):
    df[newcolNames[k]] = newcols[k]
  return df
df2 = makeGrammar(df)
df2.to_csv('/Users/emilydavis/Desktop/paper data/pilotExperIter/allDataWriteGrammarPilotIter1.csv')       
